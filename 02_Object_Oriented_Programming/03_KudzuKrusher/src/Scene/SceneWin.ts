import CanvasRenderer from '../CanvasRenderer.js';
import MouseListener from '../MouseListener.js';
import Scene from './Scene.js';
import SceneStart from './SceneStart.js';

export default class SceneWin extends Scene {
  private continue: boolean = false;

  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
  }

  public override processInput(mouseListener: MouseListener): void {
    if (mouseListener.buttonPressed(MouseListener.BUTTON_LEFT)) {
      this.continue = true;
    }
  }

  public override update(elapsed: number): void {

  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new SceneStart(this.maxX, this.maxY);
    }
    return null;
  }

  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.writeText(canvas, 'You Win', this.maxX / 2, this.maxY / 2 - 80, 'center', 'Arial', 45, 'white');
  }
}
