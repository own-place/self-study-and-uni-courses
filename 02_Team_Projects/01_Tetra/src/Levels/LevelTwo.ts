import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import Level from './Level.js';
import ScoreItem from '../CanvasItems/ScoreItem.js';
import MouseListener from '../helperFile/MouseListener.js';
import LevelThree from './LevelThree.js';

export default class LevelTwo extends Level {
  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY, startScore);
    document.body.style.backgroundImage = 'url("./assets/map02.jpg")';
    this.hintImage = CanvasRenderer.loadNewImage('./assets/level2-instructions.png');
    this.currentLevel = 2;
    this.alien = new Alien(maxX * 0.28, maxY * 0.82);
    this.portal = new Button(maxX * 0.32, maxY * 0.15, 'portal');
    this.cheese = new ScoreItem(maxX * 0.32, maxY * 0.5, 'cheese');
    this.displayCheese = true;
    this.setInputBox();
    this.input.appendChild(this.option02);
  }

  /**
   *
   * @param mouseListener mouse
   */
  public override processInput(mouseListener: MouseListener): void {
    this.setButtons(mouseListener);

    // set collect feedback
    if (this.displayCollectFeedback && mouseListener.buttonPressed(MouseListener.BUTTON_LEFT)) {
      this.displayCollectFeedback = false;
    }
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
      return new LevelThree(this.maxX, this.maxY, this.currentScore);
    }
    return null;
  }
}
