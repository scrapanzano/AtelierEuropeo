<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    private const TESTIMONIANZE = [
        'Partecipare a questo progetto è stata un\'esperienza trasformativa. Ho avuto l\'opportunità di collaborare con giovani da tutta Europa e di sviluppare competenze che porterò con me per tutta la vita. L\'organizzazione è stata eccellente e il supporto costante.',
        'Un\'esperienza incredibile che mi ha permesso di crescere sia professionalmente che personalmente. Il progetto era ben strutturato, gli obiettivi chiari e il team di supporto sempre disponibile. Consiglio vivamente questa opportunità a tutti i giovani.',
        'Grazie a questo progetto ho potuto mettere in pratica le mie competenze in un contesto internazionale e multiculturale. L\'impatto sulla comunità locale è stato tangibile e questo mi ha dato una grande soddisfazione personale.',
        'La qualità dell\'organizzazione e la professionalità del team di coordinamento hanno reso questa esperienza unica. Ho imparato molto sui temi europei e ho sviluppato una rete di contatti internazionale preziosa.',
        'Questo progetto mi ha aperto gli occhi su realtà diverse dalla mia e mi ha insegnato l\'importanza della solidarietà europea. L\'esperienza pratica acquisita è stata fondamentale per il mio percorso professionale.',
        'Partecipare a questo progetto è stato il modo perfetto per mettere in pratica i miei studi e vedere come le politiche europee si traducono in azioni concrete sul territorio. Un\'esperienza formativa completa.',
        'L\'atmosfera di collaborazione e scambio culturale è stata straordinaria. Ho lavorato con persone motivate e competenti, imparando nuove competenze tecniche ma anche soft skill preziose come la comunicazione interculturale.',
        'Il progetto ha superato le mie aspettative. La formazione ricevuta, l\'accompagnamento durante tutto il percorso e l\'impatto positivo che abbiamo generato insieme rendono questa esperienza indimenticabile.',
        'Consiglio caldamente questa esperienza a chiunque voglia fare la differenza e crescere in un ambiente internazionale. Il progetto mi ha dato strumenti concreti per il mio futuro e una nuova prospettiva sull\'Europa.',
        'La dimensione europea del progetto mi ha permesso di comprendere meglio le sfide e le opportunità del nostro continente. È stata un\'esperienza di cittadinanza attiva che mi ha arricchito enormemente.',
        'Non mi aspettavo di tornare cambiata così profondamente. Ogni giorno era diverso, pieno di sfide e scoperte. Il lavoro svolto con la comunità locale mi ha insegnato che il volontariato è prima di tutto un atto di ascolto.',
        'Ho conosciuto persone straordinarie provenienti da dieci paesi diversi. La convivenza quotidiana, le discussioni su cultura e valori, le cene condivise: tutto questo ha reso il progetto molto più di un semplice servizio di volontariato.',
        'Il supporto dell\'organizzazione ospitante è stato impeccabile: dai materiali formativi alle attività di team building, tutto era pensato per farci sentire parte di qualcosa di grande. Tornerò sicuramente a partecipare.',
        'La parte più bella è stata vedere i beneficiari delle nostre attività sorridere e ringraziarci. In quei momenti ho capito davvero perché avevo scelto questo percorso. Un\'esperienza che raccomando con tutto il cuore.',
        'Ho imparato una lingua nuova, ho scoperto una cultura meravigliosa e ho contribuito a un progetto che continuerà a produrre effetti positivi anche dopo la mia partenza. Questo è il valore aggiunto del Corpo Europeo di Solidarietà.',
    ];

    public function definition(): array
    {
        return [
            'author_id'  => User::factory(),
            'project_id' => Project::factory(),
            'content'    => $this->faker->randomElement(self::TESTIMONIANZE),
            'created_at' => $this->faker->dateTimeBetween('-18 months', '-1 week'),
            'updated_at' => now(),
        ];
    }
}
