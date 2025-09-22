<div id="funFacts" class="relative w-full mx-auto mb-8">
    <div class="items-center justify-center">
        <div class="stacked-cards text-center">
            <div class="card bg-purple-500 rotate-6 hover:rotate-0 transition-transform duration-300 ease-in-out"
                 style="transform-origin: bottom center;">Every week you have to book your desk! By doing this, the
                office has become a modern and clean environment for all employees to strive and perform better.
                However, the number of desks is smaller than the number of people working in Syntess, thus some people
                have to work from home.
            </div>
            <div class="card bg-purple-400 -rotate-2 hover:rotate-0 transition-transform duration-300 ease-in-out"
                 style="transform-origin: bottom center;">Are you a trainee and in possession of a driver's license? Then you can use the Syntess Fiat 500! You have to
                be quick otherwise there are quick a lot of other interns who might want to use this amazing
                opportunity!
            </div>
            <div class="card bg-purple-600 rotate-3 hover:rotate-0 transition-transform duration-300 ease-in-out"
                 style="transform-origin: bottom center;">Syntess' software integrates advanced technologies like IoT
                (Internet of Things) and AI (Artificial Intelligence) to offer predictive maintenance capabilities,
                helping businesses reduce downtime and improve operational efficiency.
            </div>
            <div class="card bg-purple-500 -rotate-6 hover:rotate-0 transition-transform duration-300 ease-in-out"
                 style="transform-origin: bottom center;">As an intern you may obtain certification and follow training courses during your internship. You can also
                earn up to 750 Euro per month + nice extras, which is a company practice to motivate our interns even more.
            </div>
            <div class="card bg-purple-600 rotate-1 hover:rotate-0 transition-transform duration-300 ease-in-out"
                 style="transform-origin: bottom center;">The company places a strong emphasis on employee recognition
                and appreciation, celebrating milestones, achievements, and contributions through awards, bonuses, and
                recognition programs. This positive reinforcement reinforces a culture of excellence and motivates
                employees to perform at their best.
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        width: 100%;
        height: 300px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: -300px;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stacked-cards {
        width: 100%;
        position: relative;
        transition: height 0.3s ease-in-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stackedCards = document.querySelector('.stacked-cards');
        const cards = stackedCards.querySelectorAll('.card');
        adjustContainerHeight();

        stackedCards.addEventListener('click', function () {
            const firstCard = stackedCards.firstElementChild;
            stackedCards.appendChild(firstCard);
            adjustContainerHeight();
        });

        //adjusts the container with the cards so that it takes the appropriate amount of space
        function adjustContainerHeight() {
            let maxOverlap = 0;

            cards.forEach((card, index) => {
                maxOverlap += index;
            });

            let containerHeight = cards[0].clientHeight + maxOverlap;
            stackedCards.style.height = containerHeight + 'px';
        }
    });
</script>
