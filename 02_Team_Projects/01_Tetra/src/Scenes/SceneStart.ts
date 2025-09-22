import Scene from './Scene.js';
import Part1 from '../SecondPage/Part1.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Button from '../CanvasItems/Button.js';

export default class SceneStart extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    this.backgroundImage = CanvasRenderer.loadNewImage('./assets/first_page_without_startBtn.png');
    this.nextBtn = new Button(this.maxX * 0.41, this.maxY * 0.85, 'startBtn');
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new Part1(this.maxX, this.maxY);
    }
    return null;
  }
}
