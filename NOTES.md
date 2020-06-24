# Notes

Run locally Project:
```
composer update --ignore-platform-reqs
php artisan key:generate
php artisan config:cache
php artisan config:clear
php artisan storage:link
php artisan serve
```

Usage of ngrok to open a tunnel
```
./ngrok authtoken 1d67TuYIUXFLtd3NsXPEOcCzNj4_ZXT9RgnTDy4TxJ9sYULM
./ngrok http 8000
```

## Mercado Pago
```
Cuenta: 4009175332806176
Fecha: 02/22
cc: 544
DNI: 46546465
```

```
 APRO: Pago aprobado.
 CONT: Pago pendiente.
 OTHE: Rechazado por error general.
 CALL: Rechazado con validación para autorizar.
 FUND: Rechazado por monto insuficiente.
 SECU: Rechazado por código de seguridad inválido.
 EXPI: Rechazado por problema con la fecha de expiración. FORM: Rechazado por error en formulario
 ```
