import Game from './Game.js';
import CanvasRenderer from './CanvasRenderer.js';
import KeyListener from './KeyListener.js';
import Player from './Player.js';
import ScoreItem from './ScoreItem.js';
import Fish from './Fish.js';
import Waste from './Waste.js';
import Capsule from './Capsule.js';

export default class OceanCleanup extends Game {
  private canvas: HTMLCanvasElement;

  private keyListener: KeyListener = new KeyListener();

  private player: Player;

  private items: ScoreItem[] = [];

  private timeToNextItem: number = 0;

  private fishCaught: number = 0;

  private score: number = 0;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.width = window.innerWidth;
    this.canvas.height = window.innerHeight;

    this.player = new Player(this.canvas.width, this.canvas.height);
  }

  /**
   * Process user input
   */
  public processInput(): void {
    if (this.keyListener.isKeyDown(KeyListener.KEY_UP)) {
      this.player.moveUp();
    }
    if (this.keyListener.isKeyDown(KeyListener.KEY_DOWN)) {
      this.player.moveDown();
    }
  }

  /**
   * generate new items
   */
  public makeItem(): void {
    // generate fishes and wastes
    if (Math.random() <= 0.3) {
      this.items.push(new Waste(this.canvas.width, this.canvas.height));
    } else {
      this.items.push(new Fish(this.canvas.width, this.canvas.height));
    }

    // generate capsules
    if (Math.random() <= 0.05) {
      this.items.push(new Capsule(this.canvas.width, this.canvas.height));
    }
  }

  /**
   * Update called from the game loop
   * @param elapsed ms since last update
   * @returns whether the game should continue
   */
  public update(elapsed: number): boolean {
    // update the position of player
    this.player.update(elapsed);

    // make the timeToNextItem decrease
    this.timeToNextItem -= elapsed;
    // call makeItem function to make new item when it comes to 0, and reset the time to 600ms
    if (this.timeToNextItem < 0) {
      this.makeItem();
      this.timeToNextItem = 600;
    }

    // update the position of each item
    this.items.forEach((item: ScoreItem) => item.update(elapsed));

    // check if the player collides with items
    const needToRemove: ScoreItem[] = [];

    for (let i: number = 0; i < this.items.length; i++) {
      if (this.player.isCollidingItem(this.items[i])) {
        this.score += this.items[i].getScore();
        if (this.items[i] instanceof Fish) {
          this.fishCaught += 1;
        }
        if (this.items[i] instanceof Capsule) {
          for (let j: number = 0; j < this.items.length; j++) {
            if (this.items[j] instanceof Waste && (this.items[i].getPosX() < this.canvas.width)) {
              needToRemove.push(this.items[j]);
              this.score += this.items[j].getScore();
            }
          }
        }
        this.items.splice(i, 1);
      }
    }

    // 遍历items数组 将它每个元素都与新数组中的元素进行比较 筛选出与新数组不同的部分
    this.items = this.items.filter((item: ScoreItem) => !needToRemove.includes(item));

    return !this.isGameOver();
  }

  /**
   * check if the game is over
   * @returns true if game is over
   */
  public isGameOver(): boolean {
    return this.fishCaught >= 10 || this.score < 0;
  }

  /**
   * Render called from the game loop
   */
  public render(): void {
    CanvasRenderer.clearCanvas(this.canvas);

    // display the player
    this.player.render(this.canvas);

    // display the score and how many fishes caught by player
    CanvasRenderer.writeText(this.canvas, `Score: ${this.score}`, 20, 40, 'left', 'Arial', 35, 'White');
    CanvasRenderer.writeText(this.canvas, `Fish Caught: ${this.fishCaught}`, 20, 80, 'left', 'Arial', 35, 'White');

    // display all the items
    this.items.forEach((item: ScoreItem) => item.render(this.canvas));

    // display the text if the game is over
    if(this.isGameOver()) {
      CanvasRenderer.writeText(this.canvas, 'Game Over', this.canvas.width / 2 - 50, this.canvas.height / 2 - 50, 'center', 'Arial', 50, 'White');
    }
  }
}
