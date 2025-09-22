import Scene from './Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Button from '../CanvasItems/Button.js';
import Credit1 from '../Credits/Credit1.js';

export default class SceneLose extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    document.body.style.backgroundImage = 'url("./assets/bg.gif")';
    this.backgroundImage = CanvasRenderer.loadNewImage('assets/game_lose.jpg');
    this.nextBtn = new Button(this.maxX * 0.72, this.maxY * 0.49, 'restartBtn');
  }

  public override getNextScene(): Scene | null {
    if(this.continue) {
      return new Credit1(this.maxX, this.maxY);
    }
    return null;
  }
}
