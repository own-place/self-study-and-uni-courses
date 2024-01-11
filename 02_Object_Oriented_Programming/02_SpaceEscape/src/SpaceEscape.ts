import { Game } from './GameLoop.js';
import CanvasRenderer from './CanvasRenderer.js';
import KeyListener from './KeyListener.js';
import Player from './Player.js';
import ScoreItem from './ScoreItem.js';
import Shield from './Shield.js';
import Meteor from './Meteor.js';

export default class SpaceEscape extends Game {
  private canvas: HTMLCanvasElement;

  private player: Player;

  private items: ScoreItem[] = [];

  private keyListener: KeyListener = new KeyListener();

  private shieldsLeft: number = 20 * 1000;

  private timeElapsed: number = 0;

  private timeToNextItem: number = 0;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.width = window.innerWidth;
    this.canvas.height = window.innerHeight;

    this.player = new Player(this.canvas.width, this.canvas.height);
  }

  /**
   * Create a new item to fly through space.
   *
   * It can either be a new power up or a new meteor, depending on random chance.
   */
  private makeItem(): void {
    if (Math.random() <= 0.2) {
      this.items.push(new Shield(this.canvas.width, this.canvas.height));
    } else {
      this.items.push(new Meteor(this.canvas.width, this.canvas.height));
    }
  }

  /**
   * Process all input. Called from the GameLoop.
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
   * Update game state. Called from the GameLoop
   *
   * @param elapsed time elapsed from the GameLoop
   * @returns true if the game should continue
   */
  public update(elapsed: number): boolean {
    // make the timeElapsed increase and the shieldsLeft decrease
    this.timeElapsed += elapsed * 0.8;
    this.shieldsLeft -= elapsed * 0.5;

    // make the timeToNextItem decrease
    this.timeToNextItem -= elapsed;
    // call makeItem function when it's less than 0, then reset it to 500
    if (this.timeToNextItem <= 0) {
      this.makeItem();
      this.timeToNextItem = 500;
    }

    // update the positions of items in each elapsed
    this.items.forEach((item: ScoreItem) => item.update(elapsed));

    // update the position of the player
    this.player.update(elapsed);

    // check if the player collides with items
    this.items = this.items.filter((item: ScoreItem) => {
      if (this.player.isCollidingItem(item)) {
        this.shieldsLeft += item.getScore();
        return false;
      }
      return true;
    });

    // for (let i: number = 0; i < this.items.length; i++) {
    //   if (this.player.isCollidingItem(this.items[i])) {
    //     this.shieldsLeft += this.items[i].getScore();
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
    return this.shieldsLeft <= 0;
  }

  /**
   * Render all the elements in the screen. Called from GameLoop
   */
  public render(): void {
    CanvasRenderer.clearCanvas(this.canvas);

    this.player.render(this.canvas);

    // display the the increasing time and how many shields left
    CanvasRenderer.writeText(this.canvas, `Time: ${Math.round(this.timeElapsed / 1000)}`, 30, 50, 'left', 'Arial', 35, 'white');
    CanvasRenderer.writeText(this.canvas, `ShieldsLeft: ${Math.round(this.shieldsLeft / 1000)}`, 30, 90, 'left', 'Arial', 35, 'white');

    // display all the items
    this.items.forEach((item: ScoreItem) => item.render(this.canvas));

    // display the text when game is over
    if (this.isGameOver()) {
      CanvasRenderer.writeText(this.canvas, 'Game Over', this.canvas.width / 2 - 50, this.canvas.height / 2 - 50, 'center', 'Arial', 50, 'White');
    }
  }
}
