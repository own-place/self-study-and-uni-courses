import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Level from './Level.js';
import LevelTwo from './LevelTwo.js';
import MouseListener from '../helperFile/MouseListener.js';

export default class LevelOne extends Level {
  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY, startScore);
    document.body.style.backgroundImage = 'url("./assets/map01.jpg")';
    this.hintImage = CanvasRenderer.loadNewImage('./assets/level1-instructions.png');
    this.currentLevel = 1;
    this.alien = new Alien(maxX * 0.28, maxY * 0.82);
    this.portal = new Button(maxX * 0.32, maxY * 0.15, 'portal');
    this.setInputBox();
  }

  /**
   *
   * @param mouseListener mouse
   */
  public override processInput(mouseListener: MouseListener): void {
    this.setButtons(mouseListener);
  }

  /**
   *
   * @param canvas html element
   */
  public override render(canvas: HTMLCanvasElement): void {
    this.rendering(canvas);
    this.mouse.render(canvas);
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      document.body.removeChild(document.getElementById('inputBox'));
      return new LevelTwo(this.maxX, this.maxY, this.currentScore);
    }
    return null;
  }
}
