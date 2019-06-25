<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function hello()
    {
        $this->say('Hello');
    }

    /**
     * Description
     * @param $options
     * @option delay Miliseconds delay
     * @return type
     */
    public function tryProgress($options = ['delay' => 500])
    {
        $delay = $options['delay'];
        $delayUntilProgressStart = \Robo\Robo::config()->get(\Robo\Config::PROGRESS_BAR_AUTO_DISPLAY_INTERVAL);
        $this->say("Progress bar will display after $delayUntilProgressStart seconds of activity.");
        $processList = range(1, 10);
        return $this->collectionBuilder()
            ->taskForEach($processList)
                ->iterationMessage('Processing {value}')
                ->call(
                    function ($value) use($delay) {
                        // TaskForEach::call should only be used to do
                        // non-Robo operations. To use Robo tasks in an
                        // iterator, @see TaskForEach::withBuilder.
                        usleep($delay * 1000); // delay units: msec, usleep units: usec
                    }
                )
            ->run();
    }

}