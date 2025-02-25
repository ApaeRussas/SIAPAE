<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\Expense;
use App\Models\Donation;

class SpreadsheetController extends Controller
{
    public function exportExpenses(Request $request)
    {
        $expenses = json_decode($request->expenses); // Obtém todas as despesas do ano escolhido
        if(!$expenses || count($expenses) === 0) {
            return redirect()->back()->with('error', 'Sem Gastos nesse ano para gerar uma tabela Excel');
        }        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $quant_expenses = count($expenses);
        $valueTotal = 0;
        for ($i = 0; $i < $quant_expenses; $i++) {
            $valueTotal += $expenses[$i]->price; 
        }
        $valueTotal = number_format($valueTotal, 2, ',', '.');

        // Definir os cabeçalhos das colunas
        $headers = ['ID', 'Tipo', 'Preço', 'Data de Emissão', 'Número Cupom / Fiscal', 'Empresa', 'Descrição'];
        foreach ($headers as $colIndex => $header) {
            $cell = chr(65 + $colIndex) . '1'; // Converte o índice da coluna para letra (A, B, C, ...)
            $sheet->setCellValue($cell, $header);
        }

        $rowIndex = 2;
        // Preencher os dados das despesas
        foreach ($expenses as $expense) {
            $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
            $sheet->setCellValue('B' . $rowIndex, $expense->type);
            $sheet->setCellValue('C' . $rowIndex,  'R$ ' . number_format($expense->price, 2, ',', '.'));
            $sheet->setCellValue('D' . $rowIndex, \Carbon\Carbon::createFromFormat('Y-m-d',$expense->date_of_emission)->format('d/m/Y'));
            $sheet->setCellValue('E' . $rowIndex, $expense->fiscal_number ?? $expense->cupom_number ?? '---');
            $sheet->setCellValue('F' . $rowIndex, $expense->enterprise ?? '---');
            $sheet->setCellValue('G' . $rowIndex, $expense->description ?? '---');
            
            foreach (range('A', 'G') as $col) {
                $sheet->getStyle($col . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }

            $rowIndex++; // Ajustar a linha de início dos dados
        } 
        // Valor Total:
        $sheet->setCellValue('B' . $rowIndex + 1, 'Valor Total:');
        $sheet->setCellValue('C' . $rowIndex + 1, 'R$ '. $valueTotal);

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        list($year, $month, $day) = explode('-', $expenses[0]->date_of_emission);

        $filename = 'APAE Gastos - ' . $year. '.xlsx';
        $tempPath = storage_path('app/temp/' . $filename);

        // Salvar o arquivo em um diretório temporário
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        // Retornar o arquivo para download e excluí-lo do diretório temporário após o download
        return response()->download($tempPath)->deleteFileAfterSend(true);
    }

    public function exportDonations(Request $request)
    {
        $donations = json_decode($request->donations); // Obtém todas as doações do ano escolhido
        if(!$donations || count($donations) === 0) {
            return redirect()->back()->with('error', 'Sem Doações nesse ano para gerar uma tabela Excel');
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $quant_donations = count($donations);
        $valueTotal = 0;
        for ($i = 0; $i < $quant_donations; $i++) {
            if(str_contains($donations[$i]->Jan, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jan); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jan); }
            if(str_contains($donations[$i]->Fev, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Fev); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Fev); }
            if(str_contains($donations[$i]->Mar, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Mar); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Mar); }
            if(str_contains($donations[$i]->Abr, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Abr); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Abr); }
            if(str_contains($donations[$i]->Mai, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Mai); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Mai); }
            if(str_contains($donations[$i]->Jun, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jun); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jun); }
            if(str_contains($donations[$i]->Jul, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jul); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jul); }
            if(str_contains($donations[$i]->Ago, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Ago); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Ago); }
            if(str_contains($donations[$i]->Set, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Set); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Set); }
            if(str_contains($donations[$i]->Out, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Out); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Out); }
            if(str_contains($donations[$i]->Nov, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Nov); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Nov); }
            if(str_contains($donations[$i]->Dez, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Dez); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Dez); }
        }
        $valueTotal = number_format($valueTotal, 2, ',', '.');
        
        // Definir os cabeçalhos das colunas
        $headers = ['ID', 'Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez', 'Valor Anual'];
        foreach ($headers as $colIndex => $header) {
            $cell = chr(65 + $colIndex) . '1'; // Converte o índice da coluna para letra (A, B, C, ...)
            $sheet->setCellValue($cell, $header);
        }
        
        $rowIndex = 2; 
        // Preencher os dados das doações
        foreach ($donations as $donation) {
            $sheet->setCellValue('A' . $rowIndex, $rowIndex - 1);
            $sheet->setCellValue('B' . $rowIndex, $donation->student ? $donation->student->name : 'Estudante não encontrado');
            $sheet->setCellValue('C' . $rowIndex, $donation->Jan ?? '---');
            $sheet->setCellValue('D' . $rowIndex, $donation->Fev ?? '---');
            $sheet->setCellValue('E' . $rowIndex, $donation->Mar ?? '---');
            $sheet->setCellValue('F' . $rowIndex, $donation->Abr ?? '---');
            $sheet->setCellValue('G' . $rowIndex, $donation->Mai ?? '---');
            $sheet->setCellValue('H' . $rowIndex, $donation->Jun ?? '---');
            $sheet->setCellValue('I' . $rowIndex, $donation->Jul ?? '---');
            $sheet->setCellValue('J' . $rowIndex, $donation->Ago ?? '---');
            $sheet->setCellValue('K' . $rowIndex, $donation->Set ?? '---');
            $sheet->setCellValue('L' . $rowIndex, $donation->Out ?? '---');
            $sheet->setCellValue('M' . $rowIndex, $donation->Nov ?? '---');
            $sheet->setCellValue('N' . $rowIndex, $donation->Dez ?? '---');

            $valueAnual = 0;
            if(str_contains($donation->Jan, '/ ')) { list($etc, $value) = explode('/ ', $donation->Jan); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Jan); }
            if(str_contains($donation->Fev, '/ ')) { list($etc, $value) = explode('/ ', $donation->Fev); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Fev); }
            if(str_contains($donation->Mar, '/ ')) { list($etc, $value) = explode('/ ', $donation->Mar); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Mar); }
            if(str_contains($donation->Abr, '/ ')) { list($etc, $value) = explode('/ ', $donation->Abr); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Abr); }
            if(str_contains($donation->Mai, '/ ')) { list($etc, $value) = explode('/ ', $donation->Mai); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Mai); }
            if(str_contains($donation->Jun, '/ ')) { list($etc, $value) = explode('/ ', $donation->Jun); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Jun); }
            if(str_contains($donation->Jul, '/ ')) { list($etc, $value) = explode('/ ', $donation->Jul); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Jul); }
            if(str_contains($donation->Ago, '/ ')) { list($etc, $value) = explode('/ ', $donation->Ago); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Ago); }
            if(str_contains($donation->Set, '/ ')) { list($etc, $value) = explode('/ ', $donation->Set); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Set); }
            if(str_contains($donation->Out, '/ ')) { list($etc, $value) = explode('/ ', $donation->Out); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Out); }
            if(str_contains($donation->Nov, '/ ')) { list($etc, $value) = explode('/ ', $donation->Nov); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Nov); }
            if(str_contains($donation->Dez, '/ ')) { list($etc, $value) = explode('/ ', $donation->Dez); $valueAnual += (float) str_replace(',', '.', $value);  } else { $valueAnual += (float) str_replace(',', '.', $donation->Dez); }
            $valueAnual = number_format($valueAnual, 2, ',', '.');

            $sheet->setCellValue('O' . $rowIndex, 'R$ ' . $valueAnual ?? '---');

            foreach (range('A', 'O') as $col) {
                $sheet->getStyle($col . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }
            
            $rowIndex++;
        }
        // Valor Total:
        $sheet->setCellValue('B' . $rowIndex + 1, 'Valor Total:');
        $sheet->setCellValue('C' . $rowIndex + 1, 'R$ '. $valueTotal);

        foreach (range('A', 'O') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'APAE Doações - ' . $donations[0]->year_of_donation . '.xlsx';
        $tempPath = storage_path('app/temp/' . $filename);

        // Salvar o arquivo em um diretório temporário
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        // Retornar o arquivo para download e excluí-lo do diretório temporário após o download
        return response()->download($tempPath)->deleteFileAfterSend(true);
    }
}
// $writer = new Xlsx($spreadsheet);
// $writer->save($filename);
// return response()->download($filename);