import Scene from './Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Credit1 from '../Credits/Credit1.js';
import Button from '../CanvasItems/Button.js';

export default class SceneWin extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    document.body.style.backgroundImage = 'url("./assets/bg.gif")';
    this.backgroundImage = CanvasRenderer.loadNewImage('assets/game_win.png');
    this.nextBtn = new Button(this.maxX * 0.77, this.maxY * 0.47, 'nextBtn');
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new Credit1(this.maxX, this.maxY);
    }
    return null;
  }

  /**
   *
   * @param canvas html element
   */
  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.backgroundImage, 0, 0);
    this.nextBtn.rotate(canvas, 0.1);
    this.mouse.render(canvas);
  }
}
