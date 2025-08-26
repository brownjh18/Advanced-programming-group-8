from rest_framework import viewsets
from rest_framework.decorators import action
from rest_framework.response import Response
from .models import Outcome
from .serializers import OutcomeSerializer

class OutcomeViewSet(viewsets.ModelViewSet):
    queryset = Outcome.objects.all()
    serializer_class = OutcomeSerializer

    # Custom action: list outcomes by project
    @action(detail=False, methods=['get'], url_path='by-project/(?P<project_id>[^/.]+)')
    def by_project(self, request, project_id=None):
        outcomes = Outcome.objects.filter(project_id=project_id)
        serializer = self.get_serializer(outcomes, many=True)
        return Response(serializer.data)
