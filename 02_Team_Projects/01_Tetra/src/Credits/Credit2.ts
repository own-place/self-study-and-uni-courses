import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';

export default class Credit2 extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    this.backgroundImage = CanvasRenderer.loadNewImage('assets/border_credits_part2.png');
    this.nextBtn = new Button(this.maxX * 0.45, this.maxY * 0.78, 'nextBtn');
  }

  /**
   * Gets the next scene based on player input.
   * @returns The next scene or null if no transition is needed
   */
  public override getNextScene(): Scene | null {
    if (this.continue) {
      window.location.reload();
    }
    return null;
  }

  /**
   *
   * @param canvas html element
   */
  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.backgroundImage, this.maxX * 0.2, this.maxY * -0.1);
    this.nextBtn.render(canvas);
    this.mouse.render(canvas);
  }
}
