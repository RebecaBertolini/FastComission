<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailySalesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $seller;
    public $sales;
    public $reportDate;
    public $totalSalePrice;
    public $totalComission;

    /**
     * Create a new message instance.
     */
    public function __construct($seller, $sales, $reportDate, $totalComission, $totalSalePrice)
    {
        $this->seller = $seller;
        $this->sales = $sales;
        $this->reportDate = $reportDate;
        $this->totalComission = $totalComission;
        $this->totalSalePrice = $totalSalePrice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Relatório diário de vendas FastComission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reports.daily',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
