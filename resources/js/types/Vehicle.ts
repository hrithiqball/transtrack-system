import { Booking } from './Booking';
import { Maintenance } from './Maintenance';

export type Vehicle = {
  id: number;
  brand: string;
  model: string;
  year: number;
  plateNumber: string;
  color: string;
  maintenances?: Maintenance[];
  bookings?: Booking[];
  status: string | null;
  latitude: number;
  longitude: number;
  photo: string;
};
