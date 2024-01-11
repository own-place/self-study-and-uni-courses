import CanvasItem from './CanvasItem.js';

export default abstract class ScoreItem extends CanvasItem {
  protected score: number;

  protected speed: number;

  public getScore(): number {
    return this.score;
  }
}
