import KeyListener from './KeyListener.js';
import GameItem from './GameItem.js';
import Player from './Player.js';
import CanvasRenderer from './CanvasRenderer.js';
import Key from './Key.js';
import ScoreItem from './ScoreItem.js';
import Dynamite from './Dynamite.js';

export default abstract class Level {
  protected player: Player;

  protected gameItems: GameItem[] = [];

  protected lanes: number[] = [];

  protected timeToNextItem: number = 0;

  protected score: number;

  protected maxX: number;

  protected maxY: number;

  protected currentLane: number = 1;

  protected whichLevel: number = 1;

  public constructor(maxX: number, maxY: number, startScore: number) {
    this.maxX = maxX;
    this.maxY = maxY;
    this.score = startScore;
  }

  public startLevel(): void {
    this.player = new Player(this.lanes[1], this.maxY);
  }

  protected abstract spawnNewItem(): void;

  public abstract nextLevel(): Level | null;

  public processInput(keyListener: KeyListener): void {
    if (keyListener.keyPressed(KeyListener.KEY_LEFT)) {
      if (this.currentLane > 0) {
        this.currentLane -= 1;
        this.player.move(this.lanes[this.currentLane]);
      }
    }
    if (keyListener.keyPressed(KeyListener.KEY_RIGHT)) {
      if (this.currentLane < this.lanes.length - 1) {
        this.currentLane += 1;
        this.player.move(this.lanes[this.currentLane]);
      }
    }
  }

  public update(elapsed: number): void {
    this.timeToNextItem -= elapsed;
    if (this.timeToNextItem <= 0) {
      this.spawnNewItem();
      this.timeToNextItem = 600;
    }

    this.gameItems.forEach((item: GameItem) => item.update(elapsed));

    for (let i: number = 0; i < this.gameItems.length; i++) {
      if (this.player.isCollidingWithItem(this.gameItems[i])) {
        if (this.gameItems[i] instanceof Key) {
          this.player.toggleOpen();
          this.gameItems.splice(i, 1);
        }
        if (this.gameItems[i] instanceof Dynamite) {
          this.score = 0;
          this.gameItems.splice(i, 1);
        }
        if (this.gameItems[i] instanceof ScoreItem && this.player.getChestOpen()) {
          this.score += this.gameItems[i].getScore();
          this.gameItems.splice(i, 1);
        }
      }
    }
  }

  public render(canvas: HTMLCanvasElement): void {
    this.player.render(canvas);

    for (let i: number = 0; i < this.gameItems.length; i++) {
      this.gameItems[i].render(canvas);
    }

    CanvasRenderer.writeText(canvas, `Level: ${this.whichLevel}`, this.maxX * 0.2, 50, 'left', 'Arial', 35, 'White');
    CanvasRenderer.writeText(canvas, `Score: ${this.score}`, this.maxX * 0.5, 50, 'left', 'Arial', 35, 'White');
  }
}
