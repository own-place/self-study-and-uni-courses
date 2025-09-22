import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import CanvasItem from './CanvasItem.js';

export default class Button extends CanvasItem {
  private rotation: number = 0;

  private isRotated: boolean = false;

  public constructor(posX: number, posY: number, name: string) {
    super();
    this.image = CanvasRenderer.loadNewImage(`./assets/${name}.png`);
    this.posX = posX;
    this.posY = posY;
  }
}
