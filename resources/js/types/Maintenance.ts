import { User } from '.';
import { Vehicle } from './Vehicle';

export type Maintenance = {
  id: number;
  maintenanceDate: string;
  servicedBy: User;
  vehicle: Vehicle;
  remarks: string;
  completed: boolean;
};
