import CanvasRenderer from './CanvasRenderer.js';

export default abstract class CanvasItem {
  protected image: HTMLImageElement;

  protected posX: number;

  protected posY: number;

  /**
   * get the posX
   * @returns the posX
   */
  public getPosX(): number {
    return this.posX;
  }

  /**
   * get the posY
   * @returns the posY
   */
  public getPosY(): number {
    return this.posY;
  }

  /**
   * get the Width
   * @returns the Width of the image
   */
  public getWidth(): number {
    return this.image.width;
  }

  /**
   * get the Height
   * @returns the Height of the image
   */
  public getHeight(): number {
    return this.image.height;
  }

  /**
   * Render the game
   * @param canvas canvas element
   */
  public render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.image, this.posX, this.posY);
  }

  public abstract update(elapsed: number): void;
}
