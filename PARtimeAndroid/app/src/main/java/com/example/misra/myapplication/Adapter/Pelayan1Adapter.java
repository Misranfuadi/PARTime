package com.example.misra.myapplication.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.misra.myapplication.Model.Pelayan1;

import com.example.misra.myapplication.R;

import java.util.List;

public class Pelayan1Adapter extends  RecyclerView.Adapter<Pelayan1Adapter.MyViewHolder>  {

    private List<Pelayan1> pelayanList1;

    public Pelayan1Adapter(List<Pelayan1> pelayanList1) {
        this.pelayanList1 = pelayanList1;
    }

    @Override
    public Pelayan1Adapter.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.pelayan1_recycle_view, parent, false);
        return new Pelayan1Adapter.MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Pelayan1 pelayan1 = pelayanList1.get(position);
        holder.typeloket.setText(pelayan1.getTypeLoket());
        holder.tanggal.setText(pelayan1.getTanggal());
        holder.buka.setText(pelayan1.getBuka()+"-");
        holder.tutup.setText(pelayan1.getTutup());

    }



    @Override
    public int getItemCount() {
        return pelayanList1.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView typeloket,tanggal,buka,tutup;


        public MyViewHolder(View view) {
            super(view);
            typeloket =  view.findViewById(R.id.typeloket);
            tanggal =  view.findViewById(R.id.tanggal);
            buka =  view.findViewById(R.id.buka);
            tutup =  view.findViewById(R.id.tutup);

        }
    }
}
