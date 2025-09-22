import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Level from './Level.js';
import ScoreItem from '../CanvasItems/ScoreItem.js';
import MouseListener from '../helperFile/MouseListener.js';
import SceneWin from '../Scenes/SceneWin.js';
import SceneLose from '../Scenes/SceneLose.js';

export default class LevelSix extends Level {
  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY, startScore);
    document.body.style.backgroundImage = 'url("./assets/map06.jpg")';
    this.hintImage = CanvasRenderer.loadNewImage('./assets/level6-instructions.png');
    this.currentLevel = 6;
    this.alien = new Alien(maxX * 0.15, maxY * 0.75);
    this.portal = new Button(maxX * 0.48, maxY * 0.41, 'portal');
    this.cheese = new ScoreItem(maxX * 0.17, maxY * 0.23, 'buns');
    this.cheese2 = new ScoreItem(maxX * 0.48, maxY * 0.23, 'hamburger');

    this.displayCheese = true;
    this.displayCheese2 = true;

    this.setInputBox();
    this.input.appendChild(this.option02);
    this.input.appendChild(this.option03);
    this.input.appendChild(this.option04);
    this.input.appendChild(this.option07);
    this.input.appendChild(this.option05);
    this.input.appendChild(this.option08);
    this.input.appendChild(this.option06);
  }

  /**
   * Process user input.
   * @param mouseListener mouse
   */
  public override processInput(mouseListener: MouseListener): void {
    this.setButtons(mouseListener);
  }

  /**
   * Render the scene.
   * @param canvas html element
   */
  public override render(canvas: HTMLCanvasElement): void {
    this.portal.render(canvas);

    this.rendering(canvas);

    this.mouse.render(canvas);
  }

  public override getNextScene(): Scene | null {
    if (this.continue) {
      document.body.removeChild(document.getElementById('inputBox'));
      if (this.currentScore >= 15) {
        return new SceneWin(this.maxX, this.maxY);
      } else {
        return new SceneLose(this.maxX, this.maxY);
      }
    }
    return null;
  }
}
