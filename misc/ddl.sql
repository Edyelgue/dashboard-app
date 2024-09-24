SELECT createdate, modifieddate, worklogsubmitter, incidentid,
       (JULIANDAY(modifieddate) - JULIANDAY(createdate)) AS DiferencaEmHoras
FROM change_status_incident
WHERE createdate >= DATETIME('2024-09-10 23:56:55', '-7 days') 
AND notes LIKE '%Assigned To: %'
AND notes NOT LIKE '%Assigned To: helix.user%'
ORDER BY modifieddate DESC;