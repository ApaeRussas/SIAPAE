<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('med_histories', function (Blueprint $table) {
            $table->id();
            // I - Identificacion
            $table->string('informant');
            $table->date('date_of_anamnesis');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('appraisal');
            $table->boolean('have_caregiver');
            $table->boolean('have_AEE');
            $table->string('turn_AEE')->nullable();
            $table->string('school');
            $table->string('grade_school');
            $table->string('sige');
            $table->string('turn_school');
            $table->string('not_study_justify')->nullable();
            $table->text('name_mother');
            $table->date('date_mother');
            $table->string('rg_mother');
            $table->string('profession_mother');
            $table->string('cellphone_mother')->nullable();
            $table->text('name_father');
            $table->date('date_father');
            $table->string('rg_father');
            $table->string('profession_father');
            $table->string('cellphone_father')->nullable();
            $table->string('address');
            $table->boolean('have_medication');
            $table->string('what_medication')->nullable();
            // II - Initial complaint
            $table->string('compplaint', 1024)->nullable();
            // III - Socio-family situation
            $table->string('who_lives');
            $table->string('state_parents_relation');
            $table->string('time_state_relation')->nullable();
            $table->boolean('new_relation_mother');
            $table->string('time_new_relation_mother')->nullable();
            $table->text('lives_together_new_relation_mother')->nullable();
            $table->boolean('new_relation_father');
            $table->string('time_new_relation_father')->nullable();
            $table->text('lives_together_new_relation_father')->nullable();
            $table->boolean('have_kinship_parents');
            $table->text('what_kinship_parents')->nullable();
            // IV - Gestation/birth conditions
            $table->text('have_child_desired');
            $table->string('gestation_order');
            $table->string('number_children');
            $table->boolean('history_abort');
            $table->string('abort_justify')->nullable();
            $table->text('child_adopted');
            $table->text('have_pre_natal');
            $table->string('time_gestation');
            $table->text('type_childbirth');
            $table->boolean('have_disease_gestation');
            $table->string('what_disease_gestation')->nullable();
            $table->text('have_treatment')->nullable();
            $table->string('place_birth');
            $table->boolean('have_problems_birth');
            $table->string('what_problems_birth')->nullable();
            $table->boolean('have_discharged_together');
            $table->string('detail_discharged_together')->nullable();
            $table->boolean('have_neonatal_tests');
            $table->text('result_neonatal_tests')->nullable();
            $table->string('detail_neonatal_tests')->nullable();
            $table->text('have_mother_breastfeed');
            $table->boolean('have_nozzle');
            $table->string('detail_nozzle')->nullable();
            // V - Development
            $table->boolean('have_delay_NPM');
            $table->string('detail_delay_NPM')->nullable();
            $table->boolean('have_normal_development');
            $table->string('detail_normal_development')->nullable();
            $table->boolean('have_desfrald_yet');  //Em observação
            $table->string('age_desfrald_yet')->nullable();  //Em observação
            $table->boolean('have_sphincters_control');  //Em observação
            $table->string('age_sphincters_control')->nullable();  //Em observação
            $table->text('bites_nails');
            $table->text('hurt_yourself');
            $table->text('state_sleep');
            $table->text('sleeps_in_separate');
            $table->string('sleep_time');
            $table->text('difficulty_waking_up');
            $table->text('independent_daily_activities');
            $table->string('other_difficulty', 1024)->nullable();
            // VI - Behavioral attitudes
            $table->string('child_temperament');
            $table->boolean('stubbornness');
            $table->boolean('tantrum');
            $table->boolean('lies');
            $table->boolean('aggressiveness');
            $table->boolean('shyness');
            $table->boolean('affectionate');
            $table->boolean('inappropriate_behavior');
            $table->string('how_manifests_inappropriate_behavior')->nullable();
            $table->boolean('tics_manias');
            $table->boolean('hyperfocus');
            $table->boolean('waiting_skill');
            $table->boolean('tolerates_frustration');
            $table->boolean('responds_orders');
            $table->boolean('sexual_curiosity');
            $table->string('how_manifests_sexual_curiosity')->nullable();
            $table->boolean('daily_routine');
            $table->string('rigidity_daily_routine')->nullable();
            $table->string('what_daily_routine')->nullable();
            $table->boolean('sports_activity');
            $table->string('what_sports_activity')->nullable();
            // VII - Scholarity
            $table->string('age_start_school');
            $table->string('how_school_adaptation');
            $table->boolean('have_difficulty_learning');
            $table->string('justify_difficulty_learning')->nullable();
            $table->text('school_reinforcement');
            $table->text('parents_participate_school_life');
            $table->string('favorite_activity_school');
            $table->text('complaint_behavior');
            $table->text('demonstrates_satisfaction_school');
            $table->text('report_situation_school_in_home');
            // VIII - School skills
            $table->text('knows_handle_pencil');
            $table->text('reading_letters');
            $table->text('reading_words');
            $table->text('reading_texts');
            $table->text('do_activities_autonomously');
            $table->text('not_participate_collective_activities');
            $table->text('follows_school_routine');
            $table->text('adapted_activities');
            $table->text('literacy_level');
            // IX - Medical History
            $table->boolean('have_allergy');
            $table->string('what_allergy')->nullable();
            $table->text('wear_glasses');
            $table->text('use_hearing_aid');
            $table->text('know_libras');
            $table->boolean('have_therapeutic');
            $table->string('times_days_therapeutic')->nullable();
            $table->boolean('history_disorders_family');
            $table->string('what_history_disorders_family')->nullable();
            $table->boolean('have_update_vaccines');
            $table->string('detail_update_vaccines')->nullable();
            // X - Ambiente Social e Familiar
            $table->string('relation_family_members');
            $table->text('super_protected');
            $table->boolean('have_access_cellphone');
            $table->string('time_access_cellphone')->nullable();
            $table->text('accompanies_access_cellphone')->nullable();
            // XI - Avaliando o Caee da APAEE Russas
            $table->boolean('already_had_information_institution');
            $table->string('who_recommend_institution')->nullable();
            $table->text('participate_contribution');
            // XII - Observações Gerais
            $table->string('general_observations', 1024)->nullable();
            
            $table->unsignedBigInteger('signature_id');
            $table->foreign('signature_id')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('med_histories');
    }
};
