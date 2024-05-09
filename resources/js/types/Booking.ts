export type Booking = {
  id: number;
  start_date: Date;
  end_date: Date;
  vehicle_id: number;
  user_id: number;
  notes: string;
  status: string;
};
