from django.db import models

class Facility(models.Model):
    name = models.CharField(max_length=255)
    location = models.CharField(max_length=255)
    description = models.TextField(blank=True, null=True)
    partner_organization = models.CharField(max_length=255, blank=True, null=True)
    facility_type = models.CharField(max_length=100, choices=[
        ("Lab", "Lab"),
        ("Workshop", "Workshop"),
        ("Testing Center", "Testing Center"),
    ])
    capabilities = models.TextField(help_text="E.g. CNC, PCB fabrication, materials testing")

    def __str__(self):
        return self.name
