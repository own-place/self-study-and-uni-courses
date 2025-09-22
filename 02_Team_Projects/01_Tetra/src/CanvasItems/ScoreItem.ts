import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import CanvasItem from './CanvasItem.js';

export default class ScoreItem extends CanvasItem {
  private score: number;

  public constructor(posX: number, posY: number, name: string) {
    super();
    this.image = CanvasRenderer.loadNewImage(`./assets/${name}.png`);
    this.posX = posX;
    this.posY = posY;
  }

  public getScore(): number {
    return this.score;
  }
}
