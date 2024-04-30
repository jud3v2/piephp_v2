<?php

/* PSR-12 Standard */
namespace Core;

class TemplateEngine extends Cache
{
        /**
         * @var string
         */
    private string $template;

        /**
         * @var array
         */
    private array $data;

    public function __construct(string $template, array $data)
    {
            parent::__construct($template);
        $this->template = $template;
        if (!file_exists($this->template)) {
            die("Template [{$this->template}] does not exist");
        }
        $this->data = $data;
    }

    public function render(): string
    {
        $output = file_get_contents($this->template);

        $array = [
            [
                'pattern' => '/@endif/',
                'replacement' => '<?php endif; ?>'
            ],
            [
                'pattern' => "/@elseif\((.*)\)/",
                'replacement' => '<?php elseif($1): ?>'
            ],
            [
                'pattern' => '/@else/',
                'replacement' => '<?php else: ?>'
            ],
            [
                'pattern' => '/@foreach\((.*)\)/',
                'replacement' => '<?php foreach($1): ?>'
            ],
            [
                'pattern' => '/@endforeach/',
                'replacement' => '<?php endforeach; ?>'
            ],
            [
                'pattern' => '/@isset\((.*)\)/',
                'replacement' => '<?php if (isset($1)): ?>'
            ],
            [
                'pattern' => '/@endisset/',
                'replacement' => '<?php endif; ?>'
            ],
            [
                'pattern' => '/@empty\((.*)\)/',
                'replacement' => '<?php if (empty($1)): ?>'
            ],
            [
                'pattern' => '/@endempty/',
                'replacement' => '<?php endif; ?>'
            ],
            [
                'pattern' => '/@for\((.*)\)/',
                'replacement' => '<?php for($1): ?>'
            ],
            [
                'pattern' => '/@endfor/',
                'replacement' => '<?php endfor; ?>'
            ],
            [
                'pattern' => '/@include\((.*)\)/',
                'replacement' => '<?php include $1; ?>'
            ],
            [
                'pattern' => '/@while\((.*)\)/',
                'replacement' => '<?php while($1): ?>'
            ],
            [
                'pattern' => '/@endwhile/',
                'replacement' => '<?php endwhile; ?>'
            ],
                [
                    'pattern' => '/@switch\((.*)\)/',
                    'replacement' => '<?php switch($1): ?>'
                ],
                [
                    'pattern' => '/@case\((.*)\)/',
                    'replacement' => '<?php case $1: ?>'
                ],
                [
                    'pattern' => '/@default/',
                    'replacement' => '<?php default: ?>'
                ],
                [
                    'pattern' => '/@break/',
                    'replacement' => '<?php break; ?>'
                ],
                [
                    'pattern' => '/@endswitch/',
                    'replacement' => '<?php endswitch; ?>'
                    ]
        ];

        foreach ($this->data as $key => $value) {
            foreach ($array as $item) {
                    $output = preg_replace($item['pattern'], $item['replacement'], $output);
            }

                // yes twice but ensure that all the conditions are parsed
                $output = preg_replace_callback("/@if\((.*)\)/", function ($matches) {
                        return ("<" . chr(63) . "php if($matches[1]): " . chr(63) . ">");
                }, $output);
                // Parse the template variables
                $output = preg_replace_callback("/\{\{ (?:.|\n)*? \}\}/", function ($m) {
                        $m[0] = str_replace(['{{', '}}'], '', $m[0]);
                        return "<?php echo htmlentities($m[0] ?? ''); ?>";
                }, $output);
        }
        // Cache the parsed template
        $this->set($output);
            return $output;
    }
}
