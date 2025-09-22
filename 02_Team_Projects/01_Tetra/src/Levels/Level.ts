import Alien from '../CanvasItems/Alien.js';
import Button from '../CanvasItems/Button.js';
import ScoreItem from '../CanvasItems/ScoreItem.js';
import Scene from '../Scenes/Scene.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';
import MouseListener from '../helperFile/MouseListener.js';

export default abstract class Level extends Scene {
  protected alien: Alien;

  protected currentScore: number;

  protected currentLevel: number;

  protected hintBtn: Button;

  protected runBtn: Button;

  protected portal: Button;

  protected inputBtn: Button;

  protected resetBtn: Button;

  protected closeBtn: Button;

  protected hintImage: HTMLImageElement;

  protected showHint: boolean = false;

  protected positiveFeedback01: HTMLImageElement;

  protected negativeFeedback01: HTMLImageElement;

  protected negativeFeedback02: HTMLImageElement;

  protected input: HTMLSelectElement;

  protected optionHint: HTMLOptionElement;

  protected option01: HTMLOptionElement;

  protected option02: HTMLOptionElement;

  protected option03: HTMLOptionElement;

  protected option04: HTMLOptionElement;

  protected option05: HTMLOptionElement;

  protected option06: HTMLOptionElement;

  protected option07: HTMLOptionElement;

  protected option08: HTMLOptionElement;

  protected inputArray: string[] = [];

  protected displayFeedback: boolean = false;

  protected displayCollectFeedback: boolean = false;

  protected cheese: ScoreItem;

  protected cheese2: ScoreItem;

  protected displayCheese: boolean = false;

  protected displayCheese2: boolean = false;

  protected alienTurnedRight: boolean = false;

  protected rotation: number = 0;

  public constructor(maxX: number, maxY: number, startScore: number) {
    super(maxX, maxY);
    this.hintBtn = new Button(maxX * 0.7, maxY * 0.92, 'hintBtn');
    this.runBtn = new Button(maxX * 0.79, maxY * 0.92, 'runBtn');
    this.resetBtn = new Button(maxX * 0.9, maxY * 0.92, 'resetBtn');
    this.inputBtn = new Button(maxX * 0.9, maxY * 0.08, 'inputBtn');
    this.nextBtn = new Button(80, this.maxY * 0.88, 'nextBtn');
    this.closeBtn = new Button(maxX * 0.35, maxY * 0.78, 'closeBtn');
    this.currentScore = startScore;

    this.positiveFeedback01 = CanvasRenderer.loadNewImage('./assets/positiveFeedback01.png');
    this.negativeFeedback01 = CanvasRenderer.loadNewImage('./assets/negativeFeedback01.png');
    this.negativeFeedback02 = CanvasRenderer.loadNewImage('assets/negativeFeedback02.png');
  }

  protected executeCommand(commandText: string): void {
    if (commandText === 'turnRight()') {
      this.turnRight();
    } else if (commandText === 'moveForward()') {
      this.moveForward();
    } else if (commandText === 'collect()') {
      this.collect();
    } else if (commandText === 'jump()') {
      this.jump();
    }
  }

  protected turnRight(): void {
    this.alienTurnedRight = true;
    this.rotation += Math.PI / 2;
    this.continue;
  }

  protected moveForward(): void {
    if (this.rotation === Math.PI / 2) {
      this.alien.moveRight();
      this.continue;
    } else if (this.rotation === Math.PI) {
      this.alien.moveDown();
      this.continue;
    } else {
      this.alien.moveForward();
      this.continue;
    }
  }

  protected collect(): void {
    if (this.alien.isCollidingWithItem(this.cheese)) {
      this.currentScore += 5;
      this.displayCheese = false;
    } else if (this.currentLevel === 6 && this.alien.isCollidingWithItem(this.cheese2)) {
      this.currentScore += 5;
      this.displayCheese2 = false;
    } else {
      this.displayCollectFeedback = true;
    }
  }

  protected jump(): void {
    if (this.alienTurnedRight) {
      this.alien.jumpRight();
      this.continue;
    } else {
      this.alien.jump();
      this.continue;
    }
  }

  // Execute the corresponding actions
  protected processCommands(): void {
    for (let i: number = 0; i < this.inputArray.length; i++) {
      if (this.inputArray[i].match(/startRepeat\(\d+\)/)) {
        const match: RegExpMatchArray = this.inputArray[i].match(/startRepeat\((\d+)\)/);
        const repeats: number = parseInt(match[1]);
        const repeatCommands: string[] = [];
        i += 1;
        while (this.inputArray[i] != 'endRepeat()') {
          repeatCommands.push(this.inputArray[i]);
          i += 1;
        }

        for (let j: number = 0; j < repeats; j++) {
          for (let k: number = 0; k < repeatCommands.length; k++) {
            this.executeCommand(repeatCommands[k]);
          }
        }
      }
      this.executeCommand(this.inputArray[i]);

      if (i >= this.inputArray.length - 1) {
        this.displayFeedback = true;
      }
    }
  }

  // mouse clicking functions
  protected setButtons(mouseListener: MouseListener): void {
    this.mouseX = mouseListener.getMousePosition().x;
    this.mouseY = mouseListener.getMousePosition().y;
    this.mouse.move(this.mouseX, this.mouseY);

    if (mouseListener.buttonPressed(MouseListener.BUTTON_LEFT)) {
      // hint button
      if (this.mouse.isCollidingWithItem(this.hintBtn)) {
        this.showHint = true;
      }

      // close hint
      if (this.mouse.isCollidingWithItem(this.closeBtn)) {
        this.showHint = false;
      }

      // display correct input command or display negative feedback if input is wrong
      if (this.mouse.isCollidingWithItem(this.inputBtn)
        && this.input.value !== this.optionHint.value) {
        // store the inputs in the array
        this.inputArray.push(this.input.value);
      }

      // run button
      if (this.mouse.isCollidingWithItem(this.runBtn)) {
        this.processCommands();
      }

      // reset button
      if (this.mouse.isCollidingWithItem(this.resetBtn)) {
        if (this.currentLevel === 1) {
          this.alien.setPosition(this.maxX * 0.28, this.maxY * 0.82);
        }
        if (this.currentLevel === 2) {
          this.alien.setPosition(this.maxX * 0.28, this.maxY * 0.82);
        }
        if (this.currentLevel === 3 || this.currentLevel === 5 || this.currentLevel === 6) {
          this.alien.setPosition(this.maxX * 0.15, this.maxY * 0.75);
          this.alienTurnedRight = false;
        }
        if (this.currentLevel === 4) {
          this.alien.setPosition(this.maxX * 0.1, this.maxY * 0.4);
        }

        this.displayFeedback = false;
        this.inputArray = [];
        this.currentScore -= 1;
        this.displayCollectFeedback = false;
        this.rotation = 0;
      }

      // next button
      if (this.mouse.isCollidingWithItem(this.nextBtn)) {
        this.continue = true;
      }
    }
  }

  // render items
  protected rendering(canvas: HTMLCanvasElement): void {
    // CanvasRenderer.drawImage(canvas, this.backgroundImage, 0, 0);
    this.hintBtn.render(canvas);
    this.runBtn.render(canvas);
    this.portal.render(canvas);
    this.inputBtn.render(canvas);
    this.resetBtn.render(canvas);

    CanvasRenderer.writeText(canvas, `Level: ${this.currentLevel}`, 30, 50, 'left', 'monogram', 50, 'white');
    CanvasRenderer.writeText(canvas, `Score: ${this.currentScore}`, 30, 100, 'left', 'monogram', 50, 'white');

    for (let i: number = 0; i < this.inputArray.length; i++) {
      CanvasRenderer.writeText(canvas, `${this.inputArray[i]}`, this.maxX * 0.7, this.maxY * 0.2 + i * 30, 'left', 'monogram', 40, 'black');
    }

    // check if cheese is collected
    if (this.displayCheese) {
      this.cheese.render(canvas);
    }
    if (this.displayCheese2) {
      this.cheese2.render(canvas);
    }
    // check if alien is turned
    if (this.alienTurnedRight) {
      this.alien.rotate(canvas, this.rotation);
    } else {
      this.alien.render(canvas);
    }

    // if arrives at the portal, show positive feedback, else show negative
    if (this.displayFeedback) {
      if (this.alien.isCollidingWithItem(this.portal)) {
        // eslint-disable-next-line max-len
        CanvasRenderer.drawImage(canvas, this.positiveFeedback01, this.maxX * 0.42, -50);
        this.nextBtn.render(canvas);
      } else {
        // eslint-disable-next-line max-len
        CanvasRenderer.drawImage(canvas, this.negativeFeedback01, this.maxX * 0.42, -50);
      }
    }

    // if not arrives at the cheese, show negative feedback
    if (this.displayCollectFeedback) {
      if (!this.alien.isCollidingWithItem(this.cheese)) {
        // eslint-disable-next-line max-len
        CanvasRenderer.drawImage(canvas, this.negativeFeedback02, this.maxX * 0.42, this.maxY * 0.4);
      }
    }

    // display hint image
    if (this.showHint) {
      CanvasRenderer.drawImage(canvas, this.hintImage, -200, 0);
      this.closeBtn.render(canvas);
    }
  }

  // set up the input box
  protected setInputBox(): void {
    this.input = document.createElement('select');
    this.optionHint = document.createElement('option');
    this.option01 = document.createElement('option');
    this.option02 = document.createElement('option');
    this.option03 = document.createElement('option');
    this.option04 = document.createElement('option');
    this.option05 = document.createElement('option');
    this.option06 = document.createElement('option');
    this.option07 = document.createElement('option');
    this.option08 = document.createElement('option');
    this.input.id = 'inputBox';
    this.input.style.position = 'fixed';
    this.input.style.left = (this.maxX * 0.7) + 'px';
    this.input.style.top = (this.maxY * 0.08) + 'px';
    this.input.style.border = '4px solid orange';
    this.input.style.width = '260px';
    this.input.style.height = '30px';
    this.input.style.fontSize = '20px';
    document.body.appendChild(this.input);
    this.optionHint.innerHTML = 'Select the command...';
    this.input.appendChild(this.optionHint);
    this.option01.innerHTML = 'moveForward()';
    this.input.appendChild(this.option01);
    this.option02.innerHTML = 'collect()';
    this.option03.innerHTML = 'jump()';
    this.option04.innerHTML = 'turnRight()';
    this.option05.innerHTML = 'startRepeat(3)';
    this.option06.innerHTML = 'endRepeat()';
    this.option07.innerHTML = 'startRepeat(2)';
    this.option08.innerHTML = 'startRepeat(4)';
  }
}
