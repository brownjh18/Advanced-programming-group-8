from django.db import models
from projects.models import Project

class Outcome(models.Model):
    OUTCOME_TYPES = [
        ("CAD", "CAD"),
        ("PCB", "PCB"),
        ("Prototype", "Prototype"),
        ("Report", "Report"),
        ("Business Plan", "Business Plan"),
    ]

    project = models.ForeignKey(Project, on_delete=models.CASCADE, related_name="outcomes")
    title = models.CharField(max_length=255)
    description = models.TextField(blank=True, null=True)
    artifact = models.FileField(upload_to="outcomes/", blank=True, null=True)
    outcome_type = models.CharField(max_length=50, choices=OUTCOME_TYPES)
    quality_certification = models.CharField(max_length=255, blank=True, null=True)
    commercialization_status = models.CharField(max_length=100, choices=[
        ("Demoed", "Demoed"),
        ("Market Linked", "Market Linked"),
        ("Launched", "Launched"),
    ], blank=True, null=True)

    def __str__(self):
        return f"{self.title} ({self.project.title})"
