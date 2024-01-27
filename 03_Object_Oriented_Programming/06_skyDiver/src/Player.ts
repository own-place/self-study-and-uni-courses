import CanvasItem from './CanvasItem.js';
import CanvasRenderer from './CanvasRenderer.js';
import LightItem from './LightItem.js';

export default class Player extends CanvasItem {
  private movingLeft: boolean = false;

  private movingRight: boolean = false;

  private maxX: number;

  public constructor(maxX: number, maxY: number) {
    super();

    this.maxX = maxX;

    this.image = CanvasRenderer.loadNewImage('assets/player.png');
    this.posX = maxX / 2 - 100;
    this.posY = maxY * 0.05;
  }

  /**
   * reset the status of movingLeft
   */
  public moveLeft(): void {
    this.movingLeft = true;
  }

  /**
   * reset the status of movingRight
   */
  public moveRight(): void {
    this.movingRight = true;
  }

  /**
   * Update positions of the Player
   *
   * @param elapsed milliseconds since last update
   */
  public override update(elapsed: number): void {
    if (this.movingLeft) {
      this.posX -= elapsed;
      this.movingLeft = false;
    }
    if (this.movingRight) {
      this.posX += elapsed;
      this.movingRight = false;
    }
    if (this.posX < 0) {
      this.posX = 0;
    }
    if (this.posX > this.maxX - this.image.width) {
      this.posX = this.maxX - this.image.width;
    }
  }

  /**
   * check if the player collides with items
   * @param item from LightItem
   * @returns a boolean
   */
  public collidesWithItem(item: LightItem): boolean {
    if ((item.getPosX() + item.getWidth() >= this.getPosX())
      && (item.getPosX() <= this.getPosX() + this.getWidth())
      && (item.getPosY() + item.getHeight() >= this.getPosY())
      && (item.getPosY() <= this.getPosY() + this.getHeight())) {
      return true;
    }
    return false;
  }
}
