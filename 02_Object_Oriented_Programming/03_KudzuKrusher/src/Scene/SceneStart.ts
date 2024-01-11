import Scene from './Scene.js';
import MouseListener from '../MouseListener.js';
import CanvasRenderer from '../CanvasRenderer.js';
import Level from './Level.js';

export default class SceneStart extends Scene {
  private starting: boolean = false;

  private logo: HTMLImageElement;

  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);

    this.logo = CanvasRenderer.loadNewImage('assets/logo.png');
  }

  public override processInput(mouseListener: MouseListener): void {
    if (mouseListener.buttonPressed(MouseListener.BUTTON_LEFT)) {
      this.starting = true;
    }
  }

  public override update(elapsed: number): void {

  }

  public override getNextScene(): Scene | null{
    if (this.starting) {
      return new Level(this.maxX, this.maxY);
    }
    return null;
  }

  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.drawImage(canvas, this.logo, this.maxX * 0.1, this.maxY * 0.1);
  }
}
