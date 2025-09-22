import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Level from './Level.js';
import MouseListener from '../helperFile/MouseListener.js';
import LevelFive from './LevelFive.js';

export default class LevelFour extends Level{
  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY, startScore);
    document.body.style.backgroundImage = 'url("./assets/map04.jpg")';
    this.hintImage = CanvasRenderer.loadNewImage('./assets/level4-instructions.png');
    this.currentLevel = 4;
    this.alien = new Alien(maxX * 0.1, maxY * 0.4);
    this.portal = new Button(maxX * 0.55, maxY * 0.4, 'portal');
    this.displayCheese = false;
    this.setInputBox();
    this.input.appendChild(this.option07);
    this.input.appendChild(this.option05);
    this.input.appendChild(this.option08);
    this.input.appendChild(this.option06);

    this.turnRight();
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
      return new LevelFive(this.maxX, this.maxY, this.currentScore);
    }
    return null;
  }
}
