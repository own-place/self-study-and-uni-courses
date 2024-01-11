import Level from './Level.js';
import ScoreItem from './ScoreItem.js';
import Key from './Key.js';
import Level3 from './Level3.js';

export default class Level2 extends Level {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY, 0);
    this.lanes = [160, 285, 410];
    this.whichLevel = 2;
  }

  public override spawnNewItem(): void {
    if (Math.random() <= 0.1) {
      if (Math.random() <= 0.3) {
        this.gameItems.push(new Key(this.lanes[0]));
      } else if (Math.random() <= 0.6) {
        this.gameItems.push(new Key(this.lanes[1]));
      } else if (Math.random() < 1) {
        this.gameItems.push(new Key(this.lanes[2]));
      }
    } else if (Math.random() < 1) {
      if (Math.random() <= 0.3) {
        this.gameItems.push(new ScoreItem(this.lanes[0]));
      } else if (Math.random() <= 0.6) {
        this.gameItems.push(new ScoreItem(this.lanes[1]));
      } else if (Math.random() < 1) {
        this.gameItems.push(new ScoreItem(this.lanes[2]));
      }
    }
  }

  public override nextLevel(): Level | null{
    if (this.score >= 1000) {
      return new Level3(this.maxX, this.maxY);
    }
    return null;
  }
}
