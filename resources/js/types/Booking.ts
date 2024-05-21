import { User } from '.';
import { Vehicle } from './Vehicle';

export type Booking = {
  id: number;
  startDate: Date;
  endDate: Date;
  vehicle: Vehicle;
  bookedBy: User;
  notes: string;
  status: string;
};
