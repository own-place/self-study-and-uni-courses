import CanvasRenderer from './CanvasRenderer.js';
import ScoreItem from './ScoreItem.js';

export default class Player {
  private image: HTMLImageElement;

  private posX: number;

  private posY: number;

  private speed: number = 0.5;

  private movingLeft: boolean = false;

  private movingRight: boolean = false;

  private maxX: number;

  public constructor(maxX: number, maxY: number) {
    this.image = CanvasRenderer.loadNewImage('assets/basket.png');
    this.posX = maxX / 2 - 50;
    this.posY = maxY * 0.9;

    this.maxX = maxX;
  }

  public moveLeft(): void {
    this.movingLeft = true;
  }

  public moveRight(): void {
    this.movingRight = true;
  }

  public getPosX(): number {
    return this.posX;
  }

  public getPosY(): number {
    return this.posY;
  }

  public getWidth(): number {
    return this.image.width;
  }

  public getHeight(): number {
    return this.image.height;
  }

  public isCollidingItem(item: ScoreItem): boolean {
    if ((item.getPosX() + item.getWidth() >= this.getPosX())
      && (item.getPosX() <= this.getPosX() + this.getWidth())
      && (item.getPosY() + item.getHeight() >= this.getPosY())
      && (item.getPosY() <= this.getPosY() + this.getHeight())) {
      return true;
    }
    return false;
  }

  public update(elapsed: number): void {
    if (this.movingLeft) {
      this.posX -= elapsed * this.speed;
      if (this.posX < 0) {
        this.posX = 0;
      }
      this.movingLeft = false;
    }
    if (this.movingRight) {
      this.posX += elapsed * this.speed;
      if (this.posX + (this.image.width) > this.maxX) {
        this.posX = this.maxX - (this.image.width);
      }
      this.movingRight = false;
    }
  }

  public render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.image, this.posX, this.posY);
  }
}
