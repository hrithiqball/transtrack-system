import { Maintenance } from './Maintenance';

export type Vehicle = {
  id: number;
  brand: string;
  model: string;
  year: number;
  plateNumber: string;
  color: string;
  maintenances?: Maintenance[];
  status: string;
  latitude: number;
  longitude: number;
  photo: string;
};
