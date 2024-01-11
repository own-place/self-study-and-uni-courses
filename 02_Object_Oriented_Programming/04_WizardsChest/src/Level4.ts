import Dynamite from './Dynamite.js';
import Level from './Level.js';
import ScoreItem from './ScoreItem.js';
import Key from './Key.js';

export default class Level4 extends Level {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY, 0);
    this.lanes = [35, 160, 285, 410, 535];
    this.whichLevel = 4;
  }

  public override spawnNewItem(): void {
    if (Math.random() <= 0.1) {
      if (Math.random() <= 0.2) {
        this.gameItems.push(new Key(this.lanes[0]));
      } else if (Math.random() <= 0.4) {
        this.gameItems.push(new Key(this.lanes[1]));
      } else if (Math.random() <= 0.6) {
        this.gameItems.push(new Key(this.lanes[2]));
      } else if (Math.random() <= 0.8) {
        this.gameItems.push(new Key(this.lanes[3]));
      }else if (Math.random() < 1) {
        this.gameItems.push(new Key(this.lanes[4]));
      }
    } else if (Math.random() <= 0.3) {
      if (Math.random() <= 0.2) {
        this.gameItems.push(new Dynamite(this.lanes[0]));
      } else if (Math.random() <= 0.4) {
        this.gameItems.push(new Dynamite(this.lanes[1]));
      } else if (Math.random() <= 0.6) {
        this.gameItems.push(new Dynamite(this.lanes[2]));
      } else if (Math.random() <= 0.8) {
        this.gameItems.push(new Dynamite(this.lanes[3]));
      }else if (Math.random() < 1) {
        this.gameItems.push(new Dynamite(this.lanes[4]));
      }
    } else if (Math.random() < 1) {
      if (Math.random() <= 0.2) {
        this.gameItems.push(new ScoreItem(this.lanes[0]));
      } else if (Math.random() <= 0.4) {
        this.gameItems.push(new ScoreItem(this.lanes[1]));
      } else if (Math.random() <= 0.6) {
        this.gameItems.push(new ScoreItem(this.lanes[2]));
      } else if (Math.random() <= 0.8) {
        this.gameItems.push(new ScoreItem(this.lanes[3]));
      }else if (Math.random() < 1) {
        this.gameItems.push(new ScoreItem(this.lanes[4]));
      }
    }
  }

  public override nextLevel(): Level | null{
    return null;
  }
}
