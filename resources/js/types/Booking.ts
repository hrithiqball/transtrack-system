import { User } from '.';
import { Vehicle } from './Vehicle';

export type Booking = {
  id: number;
  startDate: string;
  endDate: string;
  vehicle: Vehicle;
  bookedBy: User;
  notes: string;
  status: string;
};
