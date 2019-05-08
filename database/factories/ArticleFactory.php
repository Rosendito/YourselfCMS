<?php

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
	$title = $faker->unique()->sentence(4);

    $body = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. At cum de plurimis eadem dicit, tum certe de maximis. At certe gravius. Nos autem non solum beatae vitae istam esse oblectationem videmus, sed etiam levamentum miseriarum. At ille pellit, qui permulcet sensum voluptate. Huius, Lyco, oratione locuples, rebus ipsis ielunior. Quid, cum fictas fabulas, e quibus utilitas nulla elici potest, cum voluptate legimus? Nihil acciderat ei, quod nollet, nisi quod anulum, quo delectabatur, in mari abiecerat. <mark>Duo Reges: constructio interrete.</mark> <mark>Illi enim inter se dissentiunt.</mark> Si enim ad populum me vocas, eum. Facit enim ille duo seiuncta ultima bonorum, quae ut essent vera, coniungi debuerunt; Negat enim summo bono afferre incrementum diem. </p>

		<blockquote cite="http://loripsum.net">
		    Scripsit enim et multis saepe verbis et breviter arteque in eo libro, quem modo nominavi, mortem nihil ad nos pertinere.
		</blockquote>


		<p>Negat enim summo bono afferre incrementum diem. <i>Minime vero, inquit ille, consentit.</i> Et hanc quidem primam exigam a te operam, ut audias me quae a te dicta sunt refellentem. Putabam equidem satis, inquit, me dixisse. Cum autem in quo sapienter dicimus, id a primo rectissime dicitur. </p>

		<p>Idem adhuc; <b>A mene tu?</b> <i>Quod iam a me expectare noli.</i> Cetera illa adhibebat, quibus demptis negat se Epicurus intellegere quid sit bonum. Itaque et manendi in vita et migrandi ratio omnis iis rebus, quas supra dixi, metienda. Levatio igitur vitiorum magna fit in iis, qui habent ad virtutem progressionis aliquantum. Ut aliquid scire se gaudeant? Sed tamen intellego quid velit. </p>

		<p>Nihil enim iam habes, quod ad corpus referas; Omnes enim iucundum motum, quo sensus hilaretur. <a href="http://loripsum.net/" target="_blank">Ubi ut eam caperet aut quando?</a> </p>

		<ul>
		    <li>Quod autem principium officii quaerunt, melius quam Pyrrho;</li>
		    <li>Nam quibus rebus efficiuntur voluptates, eae non sunt in potestate sapientis.</li>
		    <li>Ex rebus enim timiditas, non ex vocabulis nascitur.</li>
		    <li>Ut pulsi recurrant?</li>
		    <li>Sed quod proximum fuit non vidit.</li>
		</ul>';

    return [
        'user_id'     => rand(1, 3),
        'category_id' => rand(1, 3),
        'title'       => $title,
        'slug'        => str_slug($title),
        'description' => $faker->text(200),
        'body'        => $body,
        'status'      => $faker->randomElement([
        	Article::PUBLISHED, Article::DRAFT,
        ]),
        'image'       => $faker->imageUrl(920, 552),
    ];
});
