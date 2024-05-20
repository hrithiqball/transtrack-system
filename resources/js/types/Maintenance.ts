import { User } from '.';
import { Vehicle } from './Vehicle';

export type Maintenance = {
  maintenanceDate: Date;
  servicedBy: User;
  vehicle: Vehicle;
  remarks: string;
};
