import { Game } from './GameLoop.js';
import CanvasRenderer from './CanvasRenderer.js';
import KeyListener from './KeyListener.js';
import Player from './Player.js';
import ScoreItem from './ScoreItem.js';
import Fruit from './Fruit.js';
import Spider from './Spider.js';

export default class FruitDrop extends Game {
  private canvas: HTMLCanvasElement;

  private player: Player;

  private items: ScoreItem[] = [];

  private keyListener: KeyListener = new KeyListener();

  private score: number = 0;

  private timeLeft: number = 60 * 1000;

  private timeToNextItem: number = 0;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.height = window.innerHeight;
    this.canvas.width = window.innerWidth;

    this.player = new Player(this.canvas.width, this.canvas.height);
  }

  /**
   * Make a new item that falls from the screen.
   */
  private makeItem(): void {
    if (Math.random() <= 0.1) {
      this.items.push(new Spider(this.canvas.width));
    } else {
      this.items.push(new Fruit(this.canvas.width));
    }
  }

  /**
   * Process all input. Called from the GameLoop.
   */
  public processInput(): void {
    if (this.keyListener.isKeyDown(KeyListener.KEY_LEFT)) {
      this.player.moveLeft();
    }
    if (this.keyListener.isKeyDown(KeyListener.KEY_RIGHT)) {
      this.player.moveRight();
    }
  }

  /**
   * Update game state. Called from the GameLoop
   *
   * @param elapsed time in ms elapsed from the GameLoop
   * @returns true if the game should continue
   */
  public update(elapsed: number): boolean {
    // make the timeLeft decrease
    this.timeLeft -= elapsed * 0.8;

    // make the player update it's position in each elapsed
    this.player.update(elapsed);

    // 1. make the timeToNextItem decrease
    this.timeToNextItem -= elapsed;
    // 2. call the makeItem function when the time is less than 0 and then reset to 300ms
    if (this.timeToNextItem <= 0) {
      this.makeItem();
      this.timeToNextItem = 300;
    }

    // make the item update it's position in each elapsed
    this.items.forEach((item: ScoreItem) => item.update(elapsed));

    this.items = this.items.filter((item: ScoreItem) => {
      if (this.player.isCollidingItem(item)) {
        this.score += item.getScore();
        return false;
      }
      return true;
    });

    // for (let i: number = 0; i < this.items.length; i++) {
    //   if (this.player.isCollidingItem(this.items[i])) {
    //     this.score += this.items[i].getScore();
    //     this.items.splice(i, 1);
    //   }
    // }

    return !this.isGameOver();
  }

  /**
   * Tests conditions whether game is over. If time left is less than 0
   *
   * @returns True if game is over
   */
  private isGameOver(): boolean {
    return this.timeLeft <= 0;
  }

  /**
   * Render all the elements in the screen.
   */
  public render(): void {
    // Clear the canvas
    CanvasRenderer.clearCanvas(this.canvas);

    // display the player(basket)
    this.player.render(this.canvas);

    // display the score and how much time left
    CanvasRenderer.writeText(this.canvas, `Score: ${this.score}`, 30, 50, 'left', 'Arial', 35, 'white');
    CanvasRenderer.writeText(this.canvas, `Time: ${Math.round(this.timeLeft / 1000)}`, 30, 90, 'left', 'Arial', 35, 'white');

    // display the items of ScoreItem
    for (let i: number = 0; i < this.items.length; i++) {
      this.items[i].render(this.canvas);
    }

    // print the text when game is over
    if (this.isGameOver()) {
      CanvasRenderer.writeText(this.canvas, 'Game Over!', 750, 400, 'center', 'sans-serif', 120, 'White');
    }
  }
}
