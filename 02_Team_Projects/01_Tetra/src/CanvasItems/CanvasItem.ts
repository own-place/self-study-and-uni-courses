import CanvasRenderer from '../helperFile/CanvasRenderer.js';

export default abstract class CanvasItem {
  protected image: HTMLImageElement;

  protected posX: number;

  protected posY: number;

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

  /**
   *
   * @param posX x
   * @param posY y
   */
  public move(posX: number, posY: number): void {
    this.posX = posX;
    this.posY = posY;
  }

  /**
   *
   * @param item canvas item
   * @returns true
   */
  public isCollidingWithItem(item: CanvasItem): boolean {
    return (this.getPosX() < item.getPosX() + item.getWidth()
      && this.getPosX() + this.getWidth() > item.getPosX()
      && this.getPosY() + this.getHeight() > item.getPosY()
      && this.getPosY() < item.getPosY() + item.getHeight());
  }

  /**
   *
   * @param canvas element
   * @param degrees rotation
   */
  public rotate(canvas: HTMLCanvasElement, degrees: number): void {
    const ctx: CanvasRenderingContext2D | null = canvas.getContext('2d');
    if (ctx) {
      // Save the current state of the context
      ctx.save();
      // Translate to the center of the button
      ctx.translate(this.posX + this.getWidth() / 2, this.posY + this.getHeight() / 2);
      // Rotate the context to the right in given angle degrees
      ctx.rotate(degrees);
      // Draw the rotated image
      CanvasRenderer.drawImage(canvas, this.image, -this.getWidth() / 2, -this.getHeight() / 2);
      // Restore the previous state of the context
      ctx.restore();
    }
  }

  /**
   *
   * @param canvas element
   */
  public render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.image, this.posX, this.posY);
  }
}
