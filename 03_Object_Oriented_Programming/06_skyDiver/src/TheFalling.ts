import Game from './Game.js';
import CanvasRenderer from './CanvasRenderer.js';
import KeyListener from './KeyListener.js';
import Player from './Player.js';
import LightItem from './LightItem.js';
import Monster from './Monster.js';
import Orb from './Orb.js';
import Cloak from './Cloak.js';

export default class TheFalling extends Game {
  private canvas: HTMLCanvasElement;

  private keyListener: KeyListener;

  private player: Player;

  private items: LightItem[] = [];

  private timeToNextItem: number = 0;

  private lightForce: number = 10 * 1000;

  private monsterCaught: number = 0;

  private secondClock: number = 0;

  private displayTheSecondClock: boolean = false;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.width = window.innerWidth;
    this.canvas.height = window.innerHeight;
    this.keyListener = new KeyListener();

    this.player = new Player(this.canvas.width, this.canvas.height);
  }

  /**
   * Process the input from the user
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
   * Update state of the game
   *
   * @param elapsed milliseconds since last update
   * @returns whether the game is still running
   */
  public update(elapsed: number): boolean {
    this.player.update(elapsed);

    this.lightForce -= elapsed * 0.8;

    this.timeToNextItem -= elapsed;
    if (this.timeToNextItem <= 0) {
      if (Math.random() <= 0.3) {
        this.items.push(new Monster(this.canvas.width, this.canvas.height));
      } else {
        this.items.push(new Orb(this.canvas.width, this.canvas.height));
      }
      if (Math.random() <= 0.05) {
        this.items.push(new Cloak(this.canvas.width, this.canvas.height));
      }
      this.timeToNextItem = Math.random() * 300 + 300;
    }

    this.items.forEach((item: LightItem) => item.update(elapsed));

    if (this.secondClock > 0) {
      this.secondClock -= elapsed * 0.8;
    }

    for (let i: number = 0; i < this.items.length; i++) {
      if (this.player.collidesWithItem(this.items[i])) {
        if (this.displayTheSecondClock) {
          if (this.items[i] instanceof Orb) {
            this.lightForce += this.items[i].getLightForce();
          }
          if (this.items[i] instanceof Cloak) {
            this.lightForce += this.items[i].getLightForce();
            this.secondClock += 15 * 1000;
          }
          this.items.splice(i, 1);
        } else {
          this.lightForce += this.items[i].getLightForce();
          if (this.items[i] instanceof Cloak) {
            this.timeToDisplayTheSecondClock();
            this.secondClock += 15 * 1000;
          }
          if (this.items[i] instanceof Monster) {
            this.monsterCaught += 1;
          }
          this.items.splice(i, 1);
        }
      }
    }

    return !this.isGameOver();
  }

  /**
   * check the status of the game
   * @returns true if game is over
   */
  public isGameOver(): boolean {
    if (this.lightForce < 0 || this.monsterCaught > 10) {
      return true;
    }
    return false;
  }

  /**
   * reset the status of displayTheSecondClock
   */
  public timeToDisplayTheSecondClock(): void {
    this.displayTheSecondClock = true;
  }

  /**
   * Render the game
   */
  public render(): void {
    CanvasRenderer.clearCanvas(this.canvas);

    this.player.render(this.canvas);

    CanvasRenderer.writeText(this.canvas, `LightForce: ${Math.round(this.lightForce / 1000)}`, 30, 50, 'left', 'Arial', 35, 'white');
    CanvasRenderer.writeText(this.canvas, `Monster: ${this.monsterCaught}`, 30, 90, 'left', 'Arial', 35, 'white');

    this.items.forEach((item: LightItem) => item.render(this.canvas));

    if (this.displayTheSecondClock) {
      CanvasRenderer.writeText(this.canvas, `ClockTime: ${Math.round(this.secondClock / 1000)}`, 30, 130, 'left', 'Arial', 35, 'white');
    }

    if (this.isGameOver()) {
      CanvasRenderer.writeText(this.canvas, 'Game Over', this.canvas.width * 0.31, this.canvas.height / 2, 'left', 'Arial', 100, 'white');
    }
  }
}
