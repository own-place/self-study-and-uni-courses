import Scene from '../Scenes/Scene.js';
import Part3 from './Part3.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Button from '../CanvasItems/Button.js';

export default class Part2 extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    this.backgroundImage = CanvasRenderer.loadNewImage('assets/second_page_with_text_02.png');
    this.nextBtn = new Button(this.maxX * 0.8, this.maxY * 0.45, 'goBtn');
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new Part3(this.maxX, this.maxY);
    }
    return null;
  }

  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.backgroundImage, 0, 0);
    this.nextBtn.rotate(canvas, 0.06);
    this.mouse.render(canvas);
  }
}
