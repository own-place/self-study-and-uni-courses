import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Credit2 from './Credit2.js';

export default class Credit1 extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    this.backgroundImage = CanvasRenderer.loadNewImage('assets/border_credits_part1.png');
    this.nextBtn = new Button(this.maxX * 0.45, this.maxY * 0.82, 'nextBtn');
  }

  /**
   * Gets the next scene based on player input.
   * @returns The next scene or null if no transition is needed
   */
  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new Credit2(this.maxX, this.maxY);
    }
    return null;
  }

  /**
   *
   * @param canvas element
   */
  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.backgroundImage, this.maxX * 0.2, this.maxY * -0.05);
    this.nextBtn.render(canvas);
    this.mouse.render(canvas);
  }
}
