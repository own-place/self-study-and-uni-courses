import Dynamite from './Dynamite.js';
import Level from './Level.js';
import ScoreItem from './ScoreItem.js';
import Key from './Key.js';
import Level4 from './Level4.js';

export default class Level3 extends Level {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY, 0);
    this.lanes = [85, 210, 335, 460];
    this.whichLevel = 3;
  }

  public override spawnNewItem(): void {
    if (Math.random() <= 0.1) {
      if (Math.random() <= 0.25) {
        this.gameItems.push(new Key(this.lanes[0]));
      } else if (Math.random() <= 0.5) {
        this.gameItems.push(new Key(this.lanes[1]));
      } else if (Math.random() <= 0.75) {
        this.gameItems.push(new Key(this.lanes[2]));
      } else if (Math.random() < 1) {
        this.gameItems.push(new Key(this.lanes[3]));
      }
    } else if (Math.random() <= 0.3) {
      if (Math.random() <= 0.25) {
        this.gameItems.push(new Dynamite(this.lanes[0]));
      } else if (Math.random() <= 0.5) {
        this.gameItems.push(new Dynamite(this.lanes[1]));
      } else if (Math.random() <= 0.75) {
        this.gameItems.push(new Dynamite(this.lanes[2]));
      } else if (Math.random() < 1) {
        this.gameItems.push(new Dynamite(this.lanes[3]));
      }
    } else if (Math.random() < 1) {
      if (Math.random() <= 0.25) {
        this.gameItems.push(new ScoreItem(this.lanes[0]));
      } else if (Math.random() <= 0.5) {
        this.gameItems.push(new ScoreItem(this.lanes[1]));
      } else if (Math.random() <= 0.75) {
        this.gameItems.push(new ScoreItem(this.lanes[2]));
      } else if (Math.random() < 1) {
        this.gameItems.push(new ScoreItem(this.lanes[3]));
      }
    }
  }

  public override nextLevel(): Level | null{
    if (this.score >= 1500) {
      return new Level4(this.maxX, this.maxY);
    }
    return null;
  }
}
