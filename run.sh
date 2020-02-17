#!/bin/bash
mysql -u root -e "use temperature;DROP table temperature;"
mysql -u root temperature < /udoate/GetThermal/temperature.sql
