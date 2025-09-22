import Button from '../CanvasItems/Button.js';
import Mouse from '../CanvasItems/Mouse.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import MouseListener from '../helperFile/MouseListener.js';

export default abstract class Scene {
  protected backgroundImage: HTMLImageElement;

  protected mouse: Mouse;

  protected nextBtn: Button;

  protected continue: boolean = false;

  protected maxX: number;

  protected maxY: number;

  protected mouseX: number;

  protected mouseY: number;

  public constructor(maxX: number, maxY: number) {
    this.maxX = maxX;
    this.maxY = maxY;
    this.mouse = new Mouse();
  }

  /**
   *
   * @param mouseListener mouse
   */
  public processInput(mouseListener: MouseListener): void {
    this.mouseX = mouseListener.getMousePosition().x;
    this.mouseY = mouseListener.getMousePosition().y;
    this.mouse.move(this.mouseX, this.mouseY);

    if (this.mouse.isCollidingWithItem(this.nextBtn)
      && mouseListener.buttonPressed(MouseListener.BUTTON_LEFT)) {
      this.continue = true;
    }
  }

  /**
   *
   * @param canvas html element
   */
  public render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.backgroundImage, 0, 0);
    this.nextBtn.render(canvas);
    this.mouse.render(canvas);
  }

  public abstract getNextScene(): Scene | null;
}
