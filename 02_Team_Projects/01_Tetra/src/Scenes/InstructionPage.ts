import Button from '../CanvasItems/Button.js';
import LevelOne from '../Levels/LevelOne.js';
import Scene from './Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';

export default class InstructionPage extends Scene {
  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);
    this.backgroundImage = CanvasRenderer.loadNewImage('./assets/third_page.png');
    this.nextBtn = new Button(this.maxX * 0.42, this.maxY * 0.78, 'nextBtn');
  }

  /**
   * Gets the next scene based on player input.
   * @returns The next scene or null if no transition is needed
   */
  public override getNextScene(): Scene | null {
    if (this.continue) {
      return new LevelOne(this.maxX, this.maxY, 0);
    }
    return null;
  }
}
