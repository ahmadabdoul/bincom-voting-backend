# bincom-voting-backend

The database is: bincom_test.sql. Download the Database at
https://drive.google.com/file/d/0B77xAtHK1hd4Ukx6SHpqTkd6TWM
/view
It contains Dummy results for the 2011 elections
from different polling units, wards, and LGA.
From INEC: Polling units are under Wards, Wards
are under LGA, LGAS are under States
:
The central idea of this client project is that given all
the individual results announced in polling units (
announced_pu_results) under any LGA, we should be
able to get an estimated result for that LGA.
This can then be cross-checked with the result
announced at the local government level (
announced_Iga_results` )
Table: polling_unit contains a list of polling units (each
polling unit has a ward ID, LGA ID, and state ID)
Table: ward contains a list of wards
Table: LGA contains a list of LGA
Table: `announced_pu_results` contains dummy
results of various polling units -
NOTE: Result from each polling unit is stored on about 9
rows with the score from each party being individual
rows.
i.e for polling_unit_uniqueid = 8 we have results as
follows:
`polling_unit`.uniqueid:
PDP: 802, DPP: 719, ACN: 416, PPA : 939, CDC: 394,
JP:
`announced_pu_results`.polling_unit_uniqueid (Note
the difference between polling_unitid and
polling_unit_uniqueid )
Table : ` announced_Iga_results` contains dummy
results of various local governments as announced at the
local government coalition centre

Question 1:
Create a page to display the result for any individual polling unit
on a web page. Note that the Database you have been given only
contains LGA's in Delta State (state id: 25).
Question 3:
Question 2:
Create a page to display the summed total result of all the polling
units under any particular local government. Local Government
should be selected using a select box.
Do NOT use the announced LGA result table to display this
required result. The announced LGA table is designed to be used
for a comparison of a summed total of all polling unit results
under any particular LGA
Create a page to be used to store results for ALL parties for a new
polling unit.
