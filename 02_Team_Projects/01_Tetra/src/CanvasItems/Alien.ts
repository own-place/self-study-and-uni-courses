import CanvasItem from './CanvasItem.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';

export default class Alien extends CanvasItem {
  public constructor(posX: number, posY: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('./assets/alien-head.png');

    this.posX = posX;

    this.posY = posY;
  }

  /**
   *
   */
  public moveForward(): void {
    this.posY = this.getPosY() - 130;
  }

  /**
   *
   */
  public moveRight(): void {
    this.posX = this.getPosX() + 140;
  }


  /**
   *
   */
  public moveDown(): void {
    this.posY = this.getPosY() + 130;
  }

  /**
   *
   */
  public jumpRight(): void {
    this.posX = this.getPosX() + 270;
  }

  /**
   *
   */
  public jump(): void {
    this.posY = this.getPosY() - 250;
  }

  public setPosition(posX: number, posY: number): void {
    this.posX = posX;
    this.posY = posY;
  }
}
