from rest_framework import viewsets, filters
from .models import Facility
from .serializers import FacilitySerializer

class FacilityViewSet(viewsets.ModelViewSet):
    queryset = Facility.objects.all()
    serializer_class = FacilitySerializer
    filter_backends = [filters.SearchFilter, filters.OrderingFilter]
    search_fields = ["name", "facility_type", "partner_organization", "capabilities"]
    ordering_fields = ["name", "location"]

