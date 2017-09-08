<style>
    .event-color{
        background-color: {{$event->color_primary}} !important;
        border-color: {{$event->color_primary}} !important;
        color: {{$event->color_secondary}} !important;
    }
    .event-bg-color{
        background-color: {{$event->color_primary}} !important;
    }
    .event-bg-color2{
        background-color: {{$event->color_secondary}} !important;
    }
    .event-button{
        background-color: {{$event->color_secondary}} !important;
        border-color: {{$event->color_secondary}} !important;
        color: {{$event->color_primary}} !important;
    }
    .event-button-rev{
        background-color: {{$event->color_primary}} !important;
        border-color: {{$event->color_primary}} !important;
        color: {{$event->color_secondary}} !important;
    }
    .event-name{
        word-spacing: 100vw;
    }
    .event-location{
        line-height: 30px;
    }
    .buy-button{
        position: absolute;
        bottom: 0px;
    }
    .event-border{
        border-color: {{$event->color_secondary}} !important;
    }
    .event-font-primary{
        color: {{$event->color_primary}} !important;
    }
    .event-font-secondary{
        color: {{$event->color_secondary}} !important;
    }
</style>