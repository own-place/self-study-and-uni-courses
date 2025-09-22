import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Level from './Level.js';
import ScoreItem from '../CanvasItems/ScoreItem.js';
import MouseListener from '../helperFile/MouseListener.js';
import LevelFive from './LevelFive.js';

export default class LevelThree extends Level{
  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY, startScore);
    document.body.style.backgroundImage = 'url("./assets/map03.jpg")';
    this.hintImage = CanvasRenderer.loadNewImage('./assets/level3-instructions.png');
    this.currentLevel = 3;
    this.alien = new Alien(maxX * 0.15, maxY * 0.75);
    this.portal = new Button(maxX * 0.48, maxY * 0.25, 'portal');
    this.cheese = new ScoreItem(maxX * 0.17, maxY * 0.23, 'candy');
    this.displayCheese = true;

    this.setInputBox();
    this.input.appendChild(this.option02);
    this.input.appendChild(this.option03);
    this.input.appendChild(this.option04);
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
   * @param canvas element
   */
  public override render(canvas: HTMLCanvasElement): void {
    this.rendering(canvas);
    this.mouse.render(canvas);
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      document.body.removeChild(document.getElementById('inputBox'));
      return new LevelFive(this.maxX, this.maxY, this.currentScore);
    }
    return null;
  }
}
