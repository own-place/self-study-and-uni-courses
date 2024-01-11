import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Player {
  private image: HTMLImageElement;

  private speed: number = 0.1;

  private acceleration: number = 0.01;

  private posX: number;

  private posY: number;

  private accelerateUp: boolean = false;

  private accelerateDown: boolean = false;

  private maxY: number;

  public constructor(maxX: number, maxY: number) {
    this.image = CanvasRenderer.loadNewImage('assets/ship.png');
    this.posX = maxX * 0.05;
    this.posY = maxY / 2 - 80;

    this.maxY = maxY;
  }

  public moveUp(): void {
    this.accelerateUp = true;
  }

  public moveDown(): void {
    this.accelerateDown = true;
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
    if (this.accelerateUp) {
      this.speed -= elapsed * this.acceleration;
      this.accelerateUp = false;
    }
    if (this.accelerateDown) {
      this.speed += elapsed * this.acceleration;
      this.accelerateDown = false;
    }

    this.posY += elapsed * this.speed;

    if (this.posY < 0) {
      this.posY = this.maxY;
    }
    if (this.posY > this.maxY) {
      this.posY = 0;
    }
  }

  public render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.image, this.posX, this.posY);
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
}
