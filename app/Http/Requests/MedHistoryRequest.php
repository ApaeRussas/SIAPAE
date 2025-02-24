<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 
     //DICA: use cntrl+H para BUSCAR um CAMPO ESPECÍFICO
    public function rules(): array
    {
        $MedHistoryId = $this->route('anamnesi'); 
        // Captura o id da rota e está estranha pois o id de anamnesis é {anamnesi}

        $rules = [
            // I - Identificacion
            'student_id' => [
                'required',
                'min:1',
                Rule::unique('med_histories')->ignore($MedHistoryId),
            ],
            'informant' => 'required|string|max:125',
            'date_of_anamnesis' => 'required|min:8',
            'appraisal' => 'required|string|max:100',
            'have_caregiver' => 'required|boolean',
            'have_AEE' => 'required|boolean',
            'turn_AEE' => 'nullable|string|max:100',
            'school' => 'required|string|max:100',
            'grade_school' => 'required|string|max:100',
            'class_school' => 'required|string|max:100',
            'turn_school' => 'required|string|max:100',
            'study' => 'nullable|string|max:100',
            'name_mother' => 'required|string',
            'date_mother' => 'required|min:8',
            'rg_mother' => 'required|string|max:100',
            'profession_mother' => 'required|string|max:100',
            'cellphone_mother' => 'nullable|string|max:15',
            'name_father' => 'required|string',
            'date_father' => 'required|min:8',
            'rg_father' => 'required|string|max:100',
            'profession_father' => 'required|string|max:100',
            'cellphone_father' => 'nullable|string|max:15',
            'address' => 'required|string|max:100',
            'have_medication' => 'required|boolean',
            'what_medication' => 'nullable|string|max:125',
            // II - Initial complaint
            'compplaint' => 'nullable|string|max:1024',
            // III - Socio-family situation
            'who_lives' => 'required|string|max:125',
            'state_parents_relation' => 'required|string|max:100',
            'time_state_relation' => 'nullable|string|max:100',
            'new_relation_mother' => 'required|boolean',
            'time_new_relation_mother' => 'nullable|string|max:100',
            'lives_together_new_relation_mother' => 'nullable|string|max:100',
            'new_relation_father' => 'required|boolean',
            'time_new_relation_father' => 'nullable|string|max:100',
            'lives_together_new_relation_father' => 'nullable|string|max:100',
            'have_kinship_parents' => 'required|boolean',
            'what_kinship_parents' => 'nullable|string',
            // IV - Gestation/birth conditions
            'have_child_desired' => 'required|string',
            'child_adopted' => 'required|string',
            'gestation_order' => 'required|string',
            'number_children' => 'required|string',
            'history_abort' => 'required|boolean',
            'abort_justify' => 'nullable|string',
            'have_pre_natal' => 'required|string',
            'time_gestation' => 'required|string',
            'type_childbirth' => 'required|string',
            'have_disease_gestation' => 'required|boolean',
            'what_disease_gestation' => 'nullable|string',
            'have_treatment' => 'nullable|string',
            'place_birth' => 'required|string',
            'have_problems_birth' => 'required|boolean',
            'what_problems_birth' => 'nullable|string',
            'have_discharged_together' => 'required|boolean',
            'detail_discharged_together' => 'nullable|string',
            'have_neonatal_tests' => 'required|boolean',
            'result_neonatal_tests' => 'nullable|string',
            'detail_neonatal_tests' => 'nullable|string',
            'have_mother_breastfeed' => 'required|string',
            'have_nozzle' => 'required|boolean',
            'detail_nozzle' => 'nullable|string',
            // V - Development
            'have_delay_NPM' => 'required|boolean',
            'detail_delay_NPM' => 'nullable|string',
            'have_normal_development' => 'required|boolean',
            'detail_normal_development' => 'nullable|string',
            'have_desfrald_yet' => 'required|boolean',
            'age_desfrald_yet' => 'nullable|string',
            'have_sphincters_control' => 'required|boolean',
            'age_sphincters_control' => 'nullable|string',
            'bites_nails' => 'required|string',
            'hurt_yourself' => 'required|string',
            'state_sleep' => 'required|string',
            'sleeps_in_separate' => 'required|string',
            'sleep_time' => 'required|string',
            'difficulty_waking_up' => 'required|string',
            'independent_daily_activities' => 'required|string',
            'other_difficulty' => 'nullable|string|max:1024',
            // VI - Behavioral attitudes
            'child_temperament' => 'required|string|max:100',
            'stubbornness' => 'required|boolean',
            'tantrum' => 'required|boolean',
            'lies' => 'required|boolean',
            'aggressiveness' => 'required|boolean',
            'shyness' => 'required|boolean',
            'affectionate' => 'required|boolean',
            'inappropriate_behavior' => 'required|boolean',
            'how_manifests_inappropriate_behavior' => 'nullable|string|max:100',
            'tics_manias' => 'required|boolean',
            'hyperfocus' => 'required|boolean',
            'waiting_skill' => 'required|boolean',
            'tolerates_frustration' => 'required|boolean',
            'responds_orders' => 'required|boolean',
            'sexual_curiosity' => 'required|boolean',
            'how_manifests_sexual_curiosity' => 'nullable|string|max:100',
            'daily_routine' => 'required|boolean',
            'rigidity_daily_routine' => 'nullable|string|max:100',
            'what_daily_routine' => 'nullable|string|max:100',
            'sports_activity' => 'required|boolean',
            'what_sports_activity' => 'nullable|string|max:125',
            // VII - Scholarity
            'age_start_school' => 'required|string|max:100',
            'how_school_adaptation' => 'required|string|max:100',
            'have_difficulty_learning' => 'required|boolean',
            'justify_difficulty_learning' => 'nullable|string|max:125',
            'school_reinforcement' => 'required|string',
            'parents_participate_school_life' => 'required|string',
            'favorite_activity_school' => 'required|string|max:100',
            'complaint_behavior' => 'required|string',
            'demonstrates_satisfaction_school' => 'required|string',
            'report_situation_school_in_home' => 'required|string',
            // VIII - School skills
            'knows_handle_pencil' => 'required|string',
            'reading_letters' => 'required|string',
            'reading_words' => 'required|string',
            'reading_texts' => 'required|string',
            'do_activities_autonomously' => 'required|string',
            'not_participate_collective_activities' => 'required|string',
            'follows_school_routine' => 'required|string',
            'adapted_activities' => 'required|string',
            'literacy_level' => 'required|string',
            // IX - Medical History
            'have_allergy' => 'required|boolean',
            'what_allergy' => 'nullable|string|max:125',
            'wear_glasses' => 'nullable|string',
            'use_hearing_aid' => 'nullable|string',
            'know_libras' => 'nullable|string',
            'have_therapeutic' => 'required|boolean',
            'times_days_therapeutic' => 'nullable|string|max:100',
            'history_disorders_family' => 'required|boolean',
            'what_history_disorders_family' => 'nullable|string|max:100',
            'have_update_vaccines' => 'required|boolean',
            'detail_update_vaccines' => 'nullable|string|max:100',
            // X - Ambiente Social e Familiar
            'relation_family_members' => 'required|string|max:100',
            'super_protected' => 'required|string',
            'have_access_cellphone' => 'required|boolean',
            'time_access_cellphone' => 'nullable|string|max:100',
            'accompanies_access_cellphone' => 'nullable|string',
            // XI - Avaliando o Caee da APAEE Russas
            'already_had_information_institution' => 'required|boolean',
            'who_recommend_institution' => 'nullable|string|max:100',
            'participate_contribution' => 'required|string',
            // XII - Observações Gerais
            'general_observations' => 'nullable|string|max:1024',

            'signature_id' => 'required|string|max:125',
        ];

        return $rules;
    }

}
